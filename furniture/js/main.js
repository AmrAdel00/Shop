$(function() {
  var winH = $(window).height() ,
  brand = $('.A').innerHeight() ,
  navbar = $('.navbar').innerHeight() ;

$('.slider , .carousel-item').height(winH - (brand + navbar)) ;

$('.features-P ul li').on('click',function(){
$(this).addClass('active').siblings().removeClass('active')  ;

if($(this).data('class') === 'all')
{
$('.shuffle-imgs .col-sm').css('opacity',1) ;
}
else
{
$('.shuffle-imgs .col-sm').css('opacity','.08') ;
$($(this).data('class')).parent().css('opacity',1) ;
}

}) ;
});