@extends('common.layout')
@include('common.head')
@section('content')

<section class="fifth-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <div class="fifth-sec-tbl inline-parent">
                        <div class="fifth-sec-cell inline">
                            <div class="slide-img">
                                <img src="front/images/texture/Phone.png" class="img-responsive" alt="">
                            </div>
                        </div>
                        <div class="fifth-sec-cell inline">                          
                                    <div class="sub-title">
                                        <h2><?=$cms['website_title'];?></h2>
                                        <div class="underline"></div>
                                    </div>
                                    <div class="text-wrp-testi">
                                       <?php $cmsDescription= Helpers::replaceStaticBlock($cms['description']);                                        
                                         echo preg_replace("/<img[^>]+\>/i", "", $cmsDescription); 
                                        ?>
                                        
                                    </div>
                           
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </section>
@endsection