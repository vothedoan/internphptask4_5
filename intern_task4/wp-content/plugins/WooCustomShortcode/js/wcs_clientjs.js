jQuery(document).ready(function(){
    console.log('client ready');
    $('.wcs__post__main--slide').slick({
        arrows:false,
        dots:false,
    });
    jQuery('.wcs__post__main__item--list').hide();
    jQuery('#select__client__liststyle').on('change',function(){
        var liststyle= jQuery('#select__client__liststyle').val();
        console.log(liststyle);
        if(liststyle=='gird')
        {
            jQuery('.wcs__post__main__item--list').hide();
            jQuery('.wcs__post__main__item--grid').show();
        }
        else
        {
            jQuery('.wcs__post__main__item--list').show();
            jQuery('.wcs__post__main__item--grid').hide();

        }
    });
});
