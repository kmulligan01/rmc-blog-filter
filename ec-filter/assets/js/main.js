(function($) {
	$doc = $(document);

	$doc.ready( function() {     

    $allText = $(".all");
    $allText.prop('checked', true);

    $newContent = $('#demo');
    $page = 1;


  toggle_check()

  //get checkbox params to send for new wp query
  function toggle_check(){

  // filter isotope
  $container = $('#is-container').isotope({
    itemSelector: '.default-grid'
  });

  $checkboxes = $('.blog-filter input');

  $checkboxes.on('click', function() {
     
    $inclusives = [];
    
    $checkboxes.each( function( i, elem ) {       
      if ( elem.checked && elem.value != 'all') {
        $inclusives.push( elem.value );         
      }         
    });

    $params = '';

    if($inclusives.length){
      $params = $inclusives.join(', ');
      $allText.prop('checked', false);
      
    }else {
      $allText.prop('checked', true);
      $params = '*';
      
    }  
    $container.isotope({ filter: $params  })   

    get_my_posts($params);
  });

}

//pagination 
$newContent.on('click', '.pagination a', function(e) {
  e.preventDefault();

  $page = parseInt($(this).attr('href').replace(/\D/g,''));
  
  get_my_posts($params,$page)
 
});

//run query to get page and posts
  function get_my_posts($params,$page) {   

    //sets page number to 1 as default instead of undefined
    if($page){
      $page
    }else{
      $page = 1;
    }

    $.ajax({
      type: 'POST',
      url: my_ajax_object.ajax_url,
      dataType: "html",
      data: { 
        action : 'get_ajax_posts', 
        params: $params,
        page: $page
      },
      success: function( response ) {      
          $newContent.html( response );    

          //toggle active/inactive on meta buttons for the filter ONLY
          $meta_btn = $('.m-active');
          $purple = $('.purple');
          $gray = $('.gray');       
          console.log($meta_btn) 
          
          if($meta_btn){
            $purple.addClass('active');
            $gray.addClass('inactive');
          }else{
            $purple.addClass('inactive');
            $gray.addClass('active');
          }
      }
  });
}

//toggle active/inactive on meta buttons for the shortcode ONLY
$meta_btn = $('.d-active');
$purple = $('.d-purple');
$gray = $('.d-gray');       
console.log($meta_btn) 

if($meta_btn){
  $purple.addClass('active');
  $gray.addClass('inactive');
}else{
  $purple.addClass('inactive');
  $gray.addClass('active');
}

});

})(jQuery);