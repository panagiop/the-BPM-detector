(function($){

    $.fn.slideforestslide = function(options) {  

    var defaults = {
        sliderWidth : 960,
        sliderHeight : 330,
        interTime : 3500,
        autoslideFlag: true
    };

    var options = $.extend(defaults, options);

    return this.each(function() {

        $(this).css({'width': defaults.sliderWidth, 'height' : defaults.sliderHeight});

        // Manipulating the DOM by inserting the left and right buttons for navigation,
        // the shapes-circles filled with white color indicating the current slide and 
        // with black in any other state.

        var currentPosition = 0,
            slideWidth = defaults.sliderWidth,
            numberOfSlides = $('.slide').length,
            slideInner = '<div id="slideInner"></div>',
            appendLeftControl = '<span class="control" id="leftControl"></span>',
            appendRightControl = '<span class="control" id="rightControl"></span>',
            appendShapes = '<div id="shapes"><ul></ul></div>',
            appendShapesList = '<li class="circle">';

        $('.slide').wrapAll(slideInner).css({'float' : 'left','width' : slideWidth});
        $('#slideInner').css('width', slideWidth * numberOfSlides);
        $('#slides').append(appendLeftControl).append(appendRightControl);
        
        // Calling the functions. 
        // createSomeCircles() : creates circles indicating the current position of each slide. 
        //manageControls() : when the last slide is reached, the right button 
        //                   becomes invisible. Same thing for the left button.
        //circleHighLight() : Highlights the circle responding to the current slide. 

        createSomeCircles();
        manageControls(currentPosition);
        circleHighLight(currentPosition);

        // Here we define the time interval between the slides by calling the function
       
        if (defaults.autoslideFlag === true) setInterval(autoSlide, defaults.interTime);
        
        $('.control').click(function(){
            if ((currentPosition === numberOfSlides -1) && 
                ($(this).attr('id') === 'leftControl') && 
                (defaults.autoslideFlag === true)) {
                currentPosition = currentPosition -1;
                currentPosition = ($(this).attr('id') === 'rightControl') ? currentPosition + 1 
                : currentPosition - 1;
            }
            if (defaults.autoslideFlag === false) {
                currentPosition = ($(this).attr('id') === 'rightControl') ? currentPosition + 1 
                : currentPosition - 1;
            }
            manageControls(currentPosition);
            circleHighLight(currentPosition);

            // Here it comes some feeling of movement. Just animate the transition bewtween 
            // the slides according to the current position each time.

            $('#slideInner').animate({marginLeft : slideWidth * (-currentPosition)});
        });

        function manageControls(position){
            if(position === 0){
                $('#leftControl').hide();
                $('#rightControl').css({'top' : '85%','right' : '-0.5%','position' : 'absolute'});
            } else {
                $('#leftControl').show().css({'top' : '85%','position' : 'absolute'});
            }
            if(position === numberOfSlides - 1){
                $('#rightControl').hide();
            } else {
                $('#rightControl').show();
            }
        }
        
        function createSomeCircles() {
            $('#slides').append(appendShapes);
            for (var j = 0; j < numberOfSlides; j++){
                $('#shapes ul').append(appendShapesList);
            }
        }

        function circleHighLight(position) {
            for (var k = 0 ; k < numberOfSlides ; k++) {
                if (position === k) {
                    $('#shapes ul li:eq('+ k +')').css({'background' : 'white'});
                } else {
                    $('#shapes ul li:eq('+ k +')').css({'background' : 'gray'});
                }
            }
        }

        function autoSlide() {
            $('#slideInner').animate({marginLeft : slideWidth * (-currentPosition)});
            manageControls(currentPosition);
            circleHighLight(currentPosition);
            currentPosition++;
            if (currentPosition === numberOfSlides) {
                currentPosition = 0;
            }
        }
    });
};
})( jQuery );