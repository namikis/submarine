$(function(){
    $('.menu_title').click(function(){
        if($('.hidden_menu').hasClass('show')){
            $('.hidden_menu').fadeOut().removeClass('show');
        }else{
            $('.hidden_menu').fadeIn().addClass('show');        
        }
    });

    $('.account_delete_button').click(function(){
        $('.modal_wrapper').fadeIn();
    });

    $(document).click(function(){
        if($(event.target).closest('.account_delete_button').length == 0){
            if($(event.target).closest('.modal').length == 0){
                $('.modal_wrapper').fadeOut();
            }
        }

        if($(event.target).closest('.menu_title').length == 0){
            if($(event.target).closest('.hidden_menu').length == 0){
            $('.hidden_menu').fadeOut().removeClass('show');
            }
        }
    });

})