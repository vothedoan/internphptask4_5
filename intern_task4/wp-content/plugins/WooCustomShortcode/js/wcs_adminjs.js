
jQuery(document).ready(function (){
 console.log("ready");
/**
 * This is function listener event click button apply -->START
 */
  jQuery("#btn__apply").on('click',function(){
      jQuery('#wcs__input').val('');
      var obj = [],
      ids = '';
          $('#multi__select__product option:selected').each(function() {
            obj.push($(this).val());
          });
          for (var i = 0; i < obj.length; i++) {
            if(i==0)
            {
              ids+='"';
            } 
            ids += obj[i] ;
              if(i<(obj.length - 1))
              {
                ids+=',';
              }
              if(i==(obj.length-1))
              {
                ids+='"';
              }
          };
          console.log(ids);
      var category= jQuery('#select__category').val();
      var stylelist = jQuery('#select__style__list').val();
      var stylesort = jQuery('#select__style__sort').val();
      var strShortcode='';
      var strShortcode_start='[wcs_shortcode';
      var strShortcode_end=']';
      strShortcode=strShortcode_start+category_func(category)+stylelist_func(stylelist)+styleSort_func(stylesort)+ids_func(ids)+strShortcode_end;
      jQuery('#wcs__input').val(strShortcode);
  });
function category_func(para)
{
  var strCate='';
  if(para!='')
  {
    strCate+=' product_cat='+para;
  }
  return strCate;
}
function stylelist_func(para)
{
  var strStyle='';
  if(para!='')
  {
    strStyle+=' liststyle='+para;
  }
  return strStyle;
}
function styleSort_func(para)
{
  var strStyle='';
  if(para!='')
  {
    strStyle+=' order='+para;
  }
  return strStyle;
}
function ids_func(para)
{
  var strStyle='';
  if(para!='')
  {
    strStyle+=' ids='+para;
  }
  return strStyle;
}
/**
 * This is function listener event click button apply -->END
 */

 /**
  * This is function listener event lick column featuer product -->START
  */
    jQuery('.checkbox__wcs').live('click',function(){
        var status;
        var idpost = jQuery(this).attr('data-value');
        if(jQuery(this).is(':checked'))
        {
            status='true';
        }
        else{
            status='flase';
        }
        console.log(idpost);
        jQuery.ajax({
            type: "post",
            url: ajaxurl,
            data: {
                'action':'change_wcs_product',
                'id':idpost,
                'status':status
            },
            success: function(msg){
                console.log(msg);
            }
        });
    });
/**
  * This is function listener event lick column featuer product -->END
  */
 /**
  * This is function listener event click button add shortcode to content page --START
  */
    jQuery('#btn__insert__shortcode').on('click',function(){
        //tinymce.activeEditor.setContent('');
        var content = jQuery('#wcs__input').val();
        tinymce.activeEditor.execCommand('mceInsertContent', false, '<br>'+content); 
        self.parent.tb_remove();
    });
 /**
  * This is function listener event click button add shortcode to content page --END
  */
 /**
  * this is function listener event on change value category -->START 
  */

 jQuery('#select__category').live('change', function(){

    console.log(jQuery('#select__category').val());
    var category= jQuery('#select__category').val();
    jQuery.ajax({
        type :'post',
        url:ajaxurl,
        data:{
           ' action':'action__onchange__select__category',
            'category':category,     
        },
        success: function(data)
        {
            jQuery('#multi__select__product').html(data);
            jQuery('#multi__select__product')[0].sumo.reload();
        }
    });
 });
 jQuery('#multi__select__product').SumoSelect({selectAll: true,search: true, searchText: 'enter product here',placeholder: 'this is product'});
 /**
  * this is function listener event on change value category -->END 
  */
 
})
