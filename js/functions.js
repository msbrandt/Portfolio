jQuery(function($){

  var windowH = $(window).height(); 
  var homeArrow = $('#scroll-down');
  var fl = $('#freelance');
  var navBtns = $('#primary.myTheme_nav > ul > li > a');
  var sections = $('section'), c = sections.length;
  var blankSlideAry = [], contentAry = [];
  var button = $('.my-nav-button');
  var needsHelp = browserCeck();

  for( var i = 0; i < c; i++){
    var currentDiv = $(sections[i]);
    var currentSec = $(currentDiv).data('magic');
    if(  currentSec == 'image' ){
        blankSlideAry.push(currentDiv);
        if(i==0){
          currentDiv.height(windowH);
          $('header').css('bottom', -windowH);
        }else{
          currentDiv.css('bottom', -windowH);
        };

    }else if( currentSec == 'na' ){
      contentAry.push(currentDiv);
      currentDiv.css('bottom', -windowH);

    };
  };

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

  button.on('click', function(e){
    if($(e.currentTarget).is('#freelance')){
      var thisHash = '#myTheme-contact';
      pageScroll(e,thisHash);
    }else{ 
      var thisHash = this.hash;
      pageScroll(e,thisHash);
    };
  });
  //*******************************************************************************************

    var homeSec = $(blankSlideAry[0]), aboutSec = $(contentAry[0]), hero = homeSec.children('#home-content');
    
    var img_section_home = $(blankSlideAry[0]),
        img_section_1 = $(blankSlideAry[1]).children('.blank'),
        img_section_2 = $(blankSlideAry[2]).children('.blank'),
        img_section_3 = $(blankSlideAry[3]).children('.blank');

    var content_about = $(contentAry[0]).height(),
        content_proj = $(contentAry[1]).offset().top-350,
        content_resum = $(contentAry[2]).offset().top-100,
        content_contact = $(contentAry[3]);
  //*******************************************************************************************

  function changeOpacity(st){
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

  function moveHero(scrollT, heroToMove, needHelp){
    var newPosition = -(scrollT / 5);
    if(needHelp){
      heroToMove.css("-webkit-transform", 'matrix(1, 0, 0, 1, 0, '+ newPosition + ')');
    }
    heroToMove.css("transform", 'matrix(1, 0, 0, 1, 0, '+ newPosition + ')');
  };

  function moveHome(scrollT, theSection, help){
      var thisHeight = theSection.offset().top;
      var backPos = scrollT / 10;
        if(help){
          theSection.css("-webkit-transform", 'matrix(1, 0, 0, 1, 0, '+ -backPos + ')');
        }
        theSection.css("transform", 'matrix(1, 0, 0, 1, 0, '+ -backPos + ')'); 
        // console.log(theSection);
  }

  function moveSection(scrollT, thisPart, useHeight, blankSl, help){
    var offsetVal = (scrollT - useHeight);
    var theID = thisPart.attr('id')
    var theHeight = blankSl.height();
    // console.log(img_section_1, blankSl);
    if(theID.indexOf('about') > -1 || theID.indexOf('resume') > -1){
      var backgroundPos = -(((offsetVal / theHeight)*2)*75);
    }
    if(theID.indexOf('projects') > -1){
      var backgroundPos = -(((offsetVal / theHeight)*2)*75)-80;
      // console.log(theID);
      // console.log("this is the project section");
    }
    if(theID.indexOf('resume') > -1){
      // var backgroundPos = -((offsetVal / theHeight)*2)*75;
      // console.log(theID);
    }

    if(help){
       blankSl.css("-webkit-transform", 'matrix(1, 0, 0, 1, 0, '+ backgroundPos + ')');
    }
    blankSl.css("transform", 'matrix(1, 0, 0, 1, 0, '+ backgroundPos + ')');
  };


  function magicScroll(images, content, helper, st){
      // console.log(content_about + " " + );
      var aboutB = content[0].height() + 200;
      var projB = content[1].offset().top-350 + 400;
      var resumB = content[2].offset().top-100;
      var contactB = content[3].offset().top-100;
      var hero = $(images[0]).children('#home-content');
      // console.log(contactB);
    	
      if(st < windowH){
        moveHero(st, hero, helper);
        moveHome( st, images[0], helper );
      }


      if( st > aboutB && st < projB ){
        var useThisContent = $(content[0]);
        var useThisImg = $(images[1]).children('.blank');
        moveSection( st, useThisContent, aboutB, useThisImg, helper );
        //   var offsetValAbt = (st - aboutB);
        //   var b = (((offsetValAbt / blankHeight)*2)*75);
        //   if((browserType.indexOf('chrome') > -1) || browserType.indexOf('applewebkit')){
        //     img_section_1.css("-webkit-transform", 'matrix(1, 0, 0, 1, 0, '+ -b + ')');

      };
        //   img_section_1.css("transform", 'matrix(1, 0, 0, 1, 0, '+ -b + ')');
        //   // console.log('change a');
        // }

      if ( st > projB && st < resumB  ){
        var useThisContent = $(content[1]);
        var useThisImg = $(images[2]).children('.blank');
        moveSection( st, useThisContent, projB, useThisImg, helper );
      //   var offsetValPrj = (st - content_proj);
      //   var bb = (((offsetValPrj / blankHeight)*2)*75)-80;

      //   if((browserType.indexOf('chrome') > -1) || browserType.indexOf('applewebkit')){
      //     img_section_2.css("-webkit-transform", 'matrix(1, 0, 0, 1, 0, '+ -bb+ ')');

      };
        //   img_section_2.css("transform", 'matrix(1, 0, 0, 1, 0, '+ -bb+ ')');
        //   // console.log('change b');

        // }
        if(st > resumB){
          var useThisContent = $(content[2]);
          var useThisImg = $(images[3]).children('.blank');
          moveSection( st, useThisContent, resumB, useThisImg, helper );

        //   var offsetValResm = (st - content_resum);
        //   if((browserType.indexOf('chrome') > -1) || browserType.indexOf('applewebkit')){
        //     img_section_3.css("-webkit-transform", 'matrix(1, 0, 0, 1, 0, '+ -transVal+ ')');

          };
        //   img_section_3.css("transform", 'matrix(1, 0, 0, 1, 0, '+ -transVal+ ')');
        //   // console.log('change c');
        // }
    
  };
  function fixNavbar(st){
    // var st = $(window).scrollTop();
    var windowH = $(window).height();
    var header = $('header'), tempHeader = $('.my-nav-temp');
    var dif1 = img_section_1.height(),
        dif2 = dif1 - 100;
      
        if(st > windowH){
          header.addClass('fix-nav');
          $('#myTheme-home').addClass('change-z')
          tempHeader.show();

        }else{
          tempHeader.hide();
          $('#myTheme-home').removeClass('change-z')
          header.removeClass('fix-nav');
        }
        if( st > 0 && st < (windowH-200)){
          navBtns.removeClass('active-nav');
          $(navBtns[0]).addClass('active-nav');
          // window.location.hash = 'about';

        }
        if( st < (content_about + dif1)){
          navBtns.removeClass('active-nav');
          $(navBtns[0]).addClass('active-nav'); 
          // window.location.hash = 'about';       
        }
        if( st > (content_about + dif1)){
          navBtns.removeClass('active-nav');
          $(navBtns[1]).addClass('active-nav');
          // window.location.hash = 'projects';
        }
        if( st > (content_proj + dif1)){
          navBtns.removeClass('active-nav');
          $(navBtns[2]).addClass('active-nav');
          // window.location.hash = 'resume';
        }
        if( st > (content_resum + dif2)){
          navBtns.removeClass('active-nav');
          $(navBtns[3]).addClass('active-nav');
          // window.location.hash = 'contact';
        }
      if(st > windowH){
        header.addClass('fix-nav');
        $('#myTheme-home').addClass('change-z')
        tempHeader.show();

      }else{
        tempHeader.hide();
        $('#myTheme-home').removeClass('change-z')
        header.removeClass('fix-nav');
      }
  }

  $(window).scroll(function(){
    var ww = $(window).width();

    var scrollT = $(window).scrollTop();
    if(ww > 769){
      magicScroll(blankSlideAry, contentAry, needsHelp, scrollT);
    };

    fixNavbar(scrollT);
    changeOpacity(scrollT);
  })


});