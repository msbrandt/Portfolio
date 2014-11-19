jQuery(function($){
  var windowH = $(window).height(); 
  var homePg = $('#myTheme-home'), aboutPg = $('#myTheme-about'), proPg = $('#myTheme-projects'), header = $('header'), tempHeader = $('.my-nav-temp');
  var projContentBox = $('.project-decp-container');
  var newh = windowH - 100;
  var homeArrow = $('main > a:first');
  var navBtns = $('#primary.myTheme_nav > ul > li > a');
  homePg.height(windowH);
  // aboutPg.css('bottom', -windowH);
  // proPg.height(windowH);

  $('.page-wrapper').not('#myTheme-home').css('bottom', -windowH);
  $('.blank-container').css('bottom', -windowH);
  header.css('bottom', -windowH);

  var sections = $('section'), c = sections.length;
  var imgAry = [], contentAry = [], locateAry = [];

  for( var i = 0; i < c; i++){
    currentDiv = $(sections[i]);
    currentChildren = currentDiv.children();
    currentSec = $(currentDiv).data('magic');
    currentTop = $(currentDiv).offset().top;

    locateAry.push(currentTop);

    if(  currentSec == 'image' ){
        imgAry.push(currentDiv);


    }else if( currentSec == 'na' ){
      contentAry.push(currentDiv);

    }
  }
  homeArrow.click(function(e){
    var ha = this.hash;
    pageScroll(e,ha);
    $(navBtns[0]).addClass('active-nav');

  });
  navBtns.click(function(e){
    var ha = this.hash;
    pageScroll(e,ha);
    navBtns.removeClass('active-nav');
    $(this).addClass('active-nav');

  })

  function pageScroll(e,hash){
    e.preventDefault();
    var theHash = $(hash).offset().top - 50;
    $('html, body').animate({
         scrollTop: theHash
       }, 750, function(){
         window.location.hash = theHash;
         console.log(hash);
         
       });    
  }
  //*******************************************************************************************
  var browserType = navigator.userAgent.toLowerCase();

  var wh = $(window).height();
  var op = 0,
      fadeSt = 50,
      fadeEnd = 1000;
    var homeSec = $(imgAry[0]), aboutSec = $(contentAry[0]), hero = homeSec.children();
    var img_section_home = $(imgAry[0]),
        img_section_1 = $(imgAry[1]).children('.blank'),
        img_section_2 = $(imgAry[2]).children('.blank'),
        img_section_3 = $(imgAry[3]).children('.blank');
   
    var content_about = $(contentAry[0]),
        content_proj = $(contentAry[1]),
        content_resum = $(contentAry[2]),
        content_contact = $(contentAry[3]);
  //*******************************************************************************************
  function magicScroll(images, content, locations){
    var st = $(window).scrollTop();

    var sb = st + wh;

    if(st > wh){
      header.addClass('fix-nav');
      $('#myTheme-home').addClass('change-z')
      tempHeader.show();

    }else{
      tempHeader.hide();
      $('#myTheme-home').removeClass('change-z')
      header.removeClass('fix-nav');
    }

    var backPos = st / 10;
  	var backPos2 = st / 5;
  	
    var aboutB = content_about.height(),
        projB = content_proj.offset().top-350,
        resmB = content_resum.offset().top-100;

      if(st<=fadeSt){
        op = 1;
      }else if(st<=fadeEnd){
        op = 1 - st / fadeEnd;
      }
      if((browserType.indexOf('chrome') > -1) || browserType.indexOf('applewebkit')){
        homeSec.css("-webkit-transform", 'matrix(1, 0, 0, 1, 0, '+ -backPos + ')');
        hero.css({"-webkit-transform": 'matrix(1, 0, 0, 1, 0, '+ -backPos2 + ')', 'opacity': op});
      }
      homeSec.css("transform", 'matrix(1, 0, 0, 1, 0, '+ -backPos + ')');
      hero.css({"transform": 'matrix(1, 0, 0, 1, 0, '+ -backPos2 + ')', 'opacity': op});

      var aboutN = aboutB + 200;
      // if(projContentBox.hasClass('active-content')){
        // var projN = projB + 600;

      // }else{
        var projN = projB + 200;

      // }

      if( st > aboutN ){
        var blankHeight = img_section_1.parent().height();
        var offsetValAbt = (st - aboutN);
        var b = (((offsetValAbt / blankHeight)*2)*75);
        if((browserType.indexOf('chrome') > -1) || browserType.indexOf('applewebkit')){
          img_section_1.css("-webkit-transform", 'matrix(1, 0, 0, 1, 0, '+ -b + ')');

        };
        img_section_1.css("transform", 'matrix(1, 0, 0, 1, 0, '+ -b + ')');

      }

      if ( st > projN ){
        var offsetValPrj = (st - projB);
        var bb = (((offsetValPrj / blankHeight)*2)*75)-60;

        if((browserType.indexOf('chrome') > -1) || browserType.indexOf('applewebkit')){
          img_section_2.css("-webkit-transform", 'matrix(1, 0, 0, 1, 0, '+ -bb+ ')');

        };
        img_section_2.css("transform", 'matrix(1, 0, 0, 1, 0, '+ -bb+ ')');


      }
      if(st > resmB){
        var offsetValResm = (st - resmB);
        var transVal = ((offsetValResm / blankHeight)*2)*75;
        if((browserType.indexOf('chrome') > -1) || browserType.indexOf('applewebkit')){
          img_section_3.css("-webkit-transform", 'matrix(1, 0, 0, 1, 0, '+ -transVal+ ')');

        };
        img_section_3.css("transform", 'matrix(1, 0, 0, 1, 0, '+ -transVal+ ')');
      }

      if( st > 0 && st < (wh-200)){
        navBtns.removeClass('active-nav');
        $(navBtns[0]).addClass('active-nav');

      }
      if( st < (aboutB + img_section_1.height())){
        navBtns.removeClass('active-nav');
        $(navBtns[0]).addClass('active-nav');        
      }
      if( st > (aboutB + img_section_1.height() - 100)){
        navBtns.removeClass('active-nav');
        $(navBtns[1]).addClass('active-nav');
      }
      if( st > (projB + img_section_1.height() - 100)){
        navBtns.removeClass('active-nav');
        $(navBtns[2]).addClass('active-nav');
      }
      if( st > (resmB + img_section_1.height() - 100)){
        navBtns.removeClass('active-nav');
        $(navBtns[3]).addClass('active-nav');
      }




  };
  $(window).scroll(function(){
  	magicScroll(imgAry, contentAry, locateAry);
  })


});