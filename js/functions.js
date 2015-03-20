jQuery(function($){

  var windowH = $(window).height(); 
  var homeArrow = $('#scroll-down');
  var fl = $('#freelance');
  var navBtns = $('#primary.myTheme_nav > ul > li > a');
  var sections = $('section'), sectionLength = sections.length;
  var button = $('.my-nav-button');
  var needsHelp = browserCeck();
  var ww = $(window).width();
  var mobile = mobileCheck();
  fixSize();

  function pageScroll(e,hash){
    e.preventDefault();
    newHash = hash.split('-')[1];
    var theHash = $(hash).offset().top - 50;
    $('html, body').animate({
         scrollTop: theHash
       }, 750, function(){
         window.location.hash = newHash;
       });    
  };

  function browserCeck(){
    var browserType = navigator.userAgent.toLowerCase();
    if((browserType.indexOf('chrome') > -1) || browserType.indexOf('applewebkit') > -1){
      wantsHelp = true;
    }else{
    var wantsHelp = false;

    }
    return wantsHelp;
  };

  function mobileCheck(){
    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
      var isMobile = true;
      $('body').addClass('myTheme-mobile');
    }else{
      var isMobile = false;
    }
    return isMobile;
  }

  function changeOpacity(st){
    var hero = $('#home-content');
    var op = 0,
      fadeSt = 50,
      fadeEnd = 1000;

      if(st<=fadeSt){
        op = 1;
      }else if(st<=fadeEnd){
        op = 1 - st / fadeEnd;
      }
      hero.css('opacity', op);
  };
  function fixSize(){
    var currentWidth = $(window).width();
    var wh = $(window).height();
    var isM = mobileCheck();
    for( var i = 0; i < sectionLength; i++){
      var currentDiv = $(sections[i]);
      var currentSec = $(currentDiv).data('magic');
      // if(currentWidth > 1024){
        if(  currentSec == 'image' ){
            if(i==0){
              currentDiv.height(wh+100);
              if(currentWidth > 1280 || !isM){
                $('header').css('bottom', -wh);
              }
            }else{
              // console.log('moble: ',wh);
              if(currentWidth > 1280 || !isM){
                currentDiv.css('bottom', -wh);
              }
            };

        }else if( currentSec == 'na' ){
          if(currentWidth > 1280 || !isM){
            currentDiv.css('bottom', -wh);
          }

        };
      // }
      // else{
        // $('#myTheme-home').height(wh);
      // }
    }
    // console.log('working');
  }
  var header = $('header'), tempHeader = $('.my-nav-temp');

  var home = $('#myTheme-home').position().top + $('#myTheme-home').height(),
      about = $('#myTheme-about').position().top + $('#myTheme-about').height(),
      projects = $('#myTheme-projects').position().top + $('#myTheme-projects').height(),
      resume = $('#myTheme-resume').position().top + $('#myTheme-resume').height();
  
  var h = document.getElementById('myTheme-home'),
      the_hero = document.getElementById('home-content'),
      ab = document.getElementById('blank-4'),
      cb = document.getElementById('blank-6'),
      s = 10;

  button.on('click', function(e){
    if($(e.currentTarget).is('#freelance')){
      var thisHash = '#myTheme-contact';
      pageScroll(e,thisHash);
        console.log(thisHash);

    }else{
      if( (ww < 1281) && $(e.currentTarget.hash).is('#myTheme-contact')){ 
        var thisHash = '#myTheme-contact';
        pageScroll(e,thisHash);
        console.log(thisHash);
        }
      else{
        var thisHash = this.hash;
        pageScroll(e,thisHash);
        console.log(thisHash);
      }
    }
  });

  window.onscroll = function(){
    var yOffset = window.pageYOffset;
    var windW = $(window).width();

    if (windW > 1280 || !mobile){
      // console.log(windW, mobile);
      var homePosition = -(yOffset / 10),
          prjBlankPos = -(yOffset/6) + 800,
          contBlankPos = -(yOffset/6) + 700,
          heroPos = -(yOffset/5);

      h.style.backgroundPosition = "50% "+homePosition+"px";
      ab.style.backgroundPosition = "50% "+prjBlankPos+"px";
      cb.style.backgroundPosition = "50% "+contBlankPos+"px";
      
      if(needsHelp){
        the_hero.style.webkitTransform = 'translateY('+heroPos+'px)';
      }

      the_hero.style.transform = 'translateY('+heroPos+'px)';
      
      changeOpacity(yOffset);

     if(yOffset > projects + 200){
        $('#myTheme-home').addClass('change-z');

     }else {
        $('#myTheme-home').removeClass('change-z');

     }
    }else{
      // console.log('true');

      if(yOffset > about ){

        $('#myTheme-home').addClass('change-z');
         
     }else {
        $('#myTheme-home').removeClass('change-z');

     }
   };

  
  };

  $(window).scroll(function(){
    var yOffset = $(window).scrollTop();

     if(yOffset > windowH ){
      header.addClass('fix-nav');
      tempHeader.addClass('show-temp');
      $(navBtns[0]).addClass('active-nav');

    }else{
      $(navBtns).removeClass('active-nav');

      tempHeader.removeClass('show-temp');
      header.removeClass('fix-nav');

    };
    if(yOffset > home){
      $(navBtns).removeClass('active-nav');

      $(navBtns[0]).addClass('active-nav');
    }
    if(yOffset > about){
      $(navBtns).removeClass('active-nav');

      $(navBtns[1]).addClass('active-nav');
    }
    if(yOffset > projects){
      $(navBtns).removeClass('active-nav');

      $(navBtns[2]).addClass('active-nav');
    }
    if(yOffset > resume-50){
      $(navBtns).removeClass('active-nav');

      $(navBtns[3]).addClass('active-nav');
    }
  })

  $(window).on('resize', function(){
    fixSize();
  });

});