@extends('layouts.app')

@section('content')
  <!-- ========================= ABOUT IMAGE =========================-->
  <div class="about_bg">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <a href="index.html"><img src="public/images/responsive-logo.png" class="responsive-logo img-fluid" alt="responsive-logo"></a>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          @include('layouts.nav')
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <h1>Galeri</h1>
        </div>
      </div>
    </div>
  </div>
  <!--//END ABOUT IMAGE -->
  <!--============================= Gallery =============================-->
  <div class="gallery-wrap">
    <div class="container">

      <div class="row">
        <div class="col-md-4">
          <a href="public/images/gallery/large_1.jpg" class="grid image-link">
            <figure class="effect-bubba gallery-img-wrap">
              <img src="public/images/gallery/gallery_1.jpg" class="img-fluid" alt="#">
              <figcaption>
               <p><i class="fa fa-search-plus fa-2x" aria-hidden="true"></i></p>
             </figcaption>
           </figure>
         </a>
       </div>
       <div class="col-md-4">
        <a href="public/images/gallery/large_2.jpg" class="grid image-link">
          <figure class="effect-bubba gallery-img-wrap">
            <img src="public/images/gallery/gallery_2.jpg" class="img-fluid" alt="#">
            <figcaption>
             <p><i class="fa fa-search-plus fa-2x" aria-hidden="true"></i></p>
           </figcaption>
         </figure>
       </a>
     </div>
     <div class="col-md-4">
      <a href="public/images/gallery/large_3.jpg" class="grid image-link">
        <figure class="effect-bubba gallery-img-wrap">
         <img src="public/images/gallery/gallery_3.jpg" class="img-fluid" alt="#">
         <figcaption>
           <p><i class="fa fa-search-plus fa-2x" aria-hidden="true"></i></p>
         </figcaption>
       </figure>
     </a>
   </div>
 </div>
 <div class="row">
  <div class="col-md-4">
    <a href="public/images/gallery/large_4.jpg" class="grid image-link">
      <figure class="effect-bubba gallery-img-wrap">
       <img src="public/images/gallery/gallery_4.jpg" class="img-fluid" alt="#">
       <figcaption>
         <p><i class="fa fa-search-plus fa-2x" aria-hidden="true"></i></p>
       </figcaption>
     </figure>
   </a>
 </div>
 <div class="col-md-4">
  <a href="public/images/gallery/large_5.jpg" class="grid image-link">
    <figure class="effect-bubba gallery-img-wrap">
     <img src="public/images/gallery/gallery_5.jpg" class="img-fluid" alt="#">
     <figcaption>
       <p><i class="fa fa-search-plus fa-2x" aria-hidden="true"></i></p>
     </figcaption>
   </figure>
 </a>
</div>
<div class="col-md-4">
  <a href="public/images/gallery/large_6.jpg" class="grid image-link">
    <figure class="effect-bubba gallery-img-wrap">
     <img src="public/images/gallery/gallery_6.jpg" class="img-fluid" alt="#">
     <figcaption>
       <p><i class="fa fa-search-plus fa-2x" aria-hidden="true"></i></p>
     </figcaption>
   </figure>
 </a>
</div>
</div>
<br>

</div>
</div>
<!--//End Gallery -->
<!--============================= FOOTER =============================-->
@endsection
