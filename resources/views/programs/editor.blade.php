<!-- ================== BEGIN PAGE LEVEL CSS STYLE ================== -->
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/jquery-filetree/jQueryFileTree.min.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('css/52style.css') }}"/>
<!-- ================== END PAGE LEVEL CSS STYLE ================== -->

<div class="panel panel-inverse panel-hover-icon">
	<div class="panel-heading">
    <div class="panel-heading-btn">
      <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
    </div>
    <h4 class="panel-title">File Editor</h4>
  </div>
  <div class="panel-body">
		<div id="editor" class="row">
			<div class="col-md-2 col-sm-3">
					<strong>File List</strong>
				<div class="file-tree m-t-20"></div>
			</div>
			<div class="col-md-10 col-sm-9">
				<ul class="editor-tabs"></ul><br>
				<pre id="ace-editor"></pre>
			</div>
		</div>
	</div>
</div>

<script src="{{ asset('plugins/jquery-filetree/jQueryFileTree.min.js') }}"></script>
<script src="{{ asset('plugins/ace/ace.js') }}" type="text/javascript" charset="utf-8"></script>
<script src="{{ asset('plugins/ace/ext-modelist.js') }}" type="text/javascript" charset="utf-8"></script>

<script>
	App.setPageTitle('{{ Settings::get_settings('app_name') }} | {{ $title }}' );
	App.setPageOption({
    pageContentFullWidth: true,
    clearOptionOnLeave: true,
  });
  App.restartGlobalFunction();
var $openFiles = [];
var editor = null;
var cntFile;
var modelist = ace.require("ace/ext/modelist");
var $laetabs = $(".editor-tabs");

$(function () {
	// Start Jquery File Tree
	$('.file-tree').fileTree({
		root: '/',
		script: "{{ url('editor_get_dir?_token=' . csrf_token()) }}"
	}, function(file) {
		//console.log(file);
		openFile(file);
		// do something with file
		// $('.selected-file').text( $('a[rel="'+file+'"]').text() );
	});

	// Start Ace editor
	editor = ace.edit("ace-editor");
  editor.setTheme("ace/theme/twilight");
  editor.session.setMode("ace/mode/javascript");
	editor.$blockScrolling = Infinity;
	editor.setOptions({autoScrollEditorIntoView: true});
  editor.renderer.setScrollMargin(0, 20, 0, 0);
	editor.commands.addCommand({
		name: 'save',
		bindKey: {win: "Ctrl-S", "mac": "Cmd-S"},
		exec: function(editor) {
			// console.log("saving", editor.session.getValue());
			saveFileCode(cntFile, editor.session.getValue(), false);
		}
	});

	setEditorSize();

	$(window).resize(function() {setEditorSize();});
});
function setEditorSize() {
	var windowHeight = $(window).height();
	var editorHeight = windowHeight-50-31;
	var treeHeight = windowHeight-70-21;
	// console.log("windowHeight	: "+windowHeight);
	// console.log("editorHeight: "+editorHeight);
	// console.log("treeHeight: "+treeHeight);

	$(".la-file-tree").height(treeHeight+"px");
	$("#ace-editor").css("height", editorHeight+"px");
	$("#ace-editor").css("max-height", editorHeight+"px");
}

$(".editor-tabs").on("click", "li i.fa", function(e) {
	filepath = $(this).parent().attr("filepath");
	closeFile(filepath);
	e.stopPropagation();
});
$(".editor-tabs").on("click", "li", function(e) {
	filepath = $(this).attr("filepath");
	openFile(filepath);
	e.stopPropagation();
});

function openFile(filepath) {
	var fileFound = fileContains(filepath);
	// console.log("openFile: "+filepath+" fileFound: "+fileFound);

	loadFileCode(filepath, false);
	// console.log($openFiles);
}

function closeFile(filepath) {
	// console.log("closeFile: "+filepath);
	// $openFiles[getFileIndex(filepath)] = null;
	var index = getFileIndex(filepath);
	// console.log("index: "+index);
	$openFiles.splice(index, 1);
	$laetabs.children("li[filepath='"+filepath+"']").remove();
	// console.log($openFiles);

	if(index != 0 && $openFiles.length != 0) {
		openFile($openFiles[index-1].filepath);
	} else {
		editor.setValue("", -1);
		editor.focus();
		editor.session.setMode("ace/mode/text");
		cntFile = "";
	}
}

function loadFileCode(filepath, reload) {
	// console.log("loadFileCode: "+filepath+" contains: "+fileContains(filepath));
	if(!fileContains(filepath)) {
		$.ajax({
			url: "{{ url('editor_get_file?_token=' . csrf_token()) }}",
			method: 'POST',
			data: {"filepath": filepath},
			async: false,
			success: function( data ) {
				//console.log(data);
				editor.setValue(data, -1);
				editor.focus();

				var mode = modelist.getModeForPath(filepath).mode;
				editor.session.setMode(mode);

				// $openFiles[getFileIndex(filepath)].filedata = data;
				// $openFiles[getFileIndex(filepath)].filemode = mode;

				$file = {
					"filepath": filepath,
					"filedata": data,
					"filemode": mode
				}
				$openFiles.push($file);
				var filename = filepath.replace(/^.*[\\\/]/, '');
				$laetabs.append('<li filepath="'+filepath+'">'+filename+' <i class="text-danger fa fa-times"></i></li>');
				highlightFileTab(filepath);
			}
		});
	} else {
		// console.log("File found offline");
		var data = $openFiles[getFileIndex(filepath)].filedata;
		editor.setValue(data, -1);
		editor.focus();
		var mode = modelist.getModeForPath(filepath).mode;
		editor.session.setMode(mode);
		highlightFileTab(filepath);
	}
}

function saveFileCode(filepath, filedata, reload) {
	//console.log("saveFileCode: "+filepath);
	if(filepath != "") {
		$(".editor-tabs li[filepath='"+filepath+"'] i.fa").removeClass("fa-times").addClass("fa-spin").addClass("fa-refresh");

		$.ajax({
			// url: "{{ url(config('laraadmin.adminRoute') . '/editor_save_file?_token=' . csrf_token()) }}",
			url: "{{ url('editor_save_file?_token=' . csrf_token()) }}",
			method: 'POST',
			data: {
				"filepath": filepath,
				"filedata": filedata
			},
			success: function( data ) {
				// console.log(data);
				$(".editor-tabs li[filepath='"+filepath+"'] i.fa").removeClass("fa-spin").removeClass("fa-refresh").addClass("fa-times");
			}
		});
	}
}

function highlightFileTab(filepath) {
	cntFile = filepath;
	$laetabs.children("li").removeClass("active");
	$laetabs.children("li[filepath='"+filepath+"']").addClass("active");
}

function getFileIndex(filepath) {
	for (var i=0; i < $openFiles.length; i++) {
		if($openFiles[i].filepath == filepath) {
			return i;
		}
	}
}

function fileContains(filepath) {
	for (var i=0; i < $openFiles.length; i++) {
		if($openFiles[i].filepath == filepath) {
			return true;
		}
	}
	return false;
}

</script>
