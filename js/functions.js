jQuery(function($){
  var windowH = $(window).height(); 
  var homePg = $('#myTheme-home'), aboutPg = $('#myTheme-about'), proPg = $('#myTheme-projects'), header = $('header'), tempHeader = $('.my-nav-temp');
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
  // console.log(sections);

  for( var i = 0; i < c; i++){
    currentDiv = $(sections[i]);
    // console.log(currentDiv);
    currentChildren = currentDiv.children();
    currentSec = $(currentDiv).data('magic');
    currentTop = $(currentDiv).offset().top;

    locateAry.push(currentTop);

    if(  currentSec == 'image' ){
      // console.log(currentDiv);
      // if(currentChildren.hasClass('blank') ){
        imgAry.push(currentDiv);

      // }

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
         
       });    
  }
  function magicScroll(images, content, locations){
    var st = $(window).scrollTop();

    var wh = $(window).height();
    var sb = st + wh;
    if(st > wh){
      header.addClass('fix-nav');
      tempHeader.show();

    }else{
      tempHeader.hide();
      header.removeClass('fix-nav');
    }

    var op = 0,
        fadeSt = 50,
        fadeEnd = 1000;

    // var backPos = st / 1.75;
    var backPos = st / 10;


  	var backPos2 = st / 5;
  	
    var projPos = st / 2.75;

    var translateVal = st / 25;
  	// var translateVal = st / 3;

  	var projScroll = st / 6;

    var homeSec = $(images[0]), aboutSec = $(contentAry[0]), hero = homeSec.children();
    // console.log(hero);
    var img_section_home = $(images[0]),
        img_section_1 = $(images[1]).children('.blank'),
        img_section_2 = $(images[2]).children('.blank'),
        img_section_3 = $(images[3]).children('.blank');
   
    var content_about = $(contentAry[0]),
        content_proj = $(contentAry[1]),
        content_resum = $(contentAry[2]),
        content_contact = $(contentAry[3]);
    
    var aboutB = content_about.height(),
        projB = content_proj.offset().top-350,
        resmB = content_resum.offset().top-100;


    // var backPos3 = 0;

    // var x = $('#blank-1').scrollTop();
        // console.log(aboutScroll);
        // console.log('back: ' +backPos);
        // console.log('scrollTop: '+st+' wh: '+wh);

      if(st<=fadeSt){
        op = 1;
      }else if(st<=fadeEnd){
        op = 1 - st / fadeEnd;
      }
      homeSec.css("transform", 'matrix(1, 0, 0, 1, 0, '+ -backPos + ')');
      hero.css({"transform": 'matrix(1, 0, 0, 1, 0, '+ -backPos2 + ')', 'opacity': op});

      var aboutN = aboutB + 200;
      var projN = projB + 100;
      // console.log(projN);

      if( st > aboutN ){
        var blankHeight = img_section_1.parent().height();
        var offsetValAbt = (st - aboutN);
        var b = (((offsetValAbt / blankHeight)*2)*75);

        img_section_1.css("transform", 'matrix(1, 0, 0, 1, 0, '+ -b + ')');

        console.log('change nav');
      }

      if ( st > projB ){
        var offsetValPrj = (st - projB);
        var bb = ((offsetValPrj / blankHeight)*2)*75;

        img_section_2.css("transform", 'matrix(1, 0, 0, 1, 0, '+ -bb+ ')');
        // console.log('change nav 2');


      }
      if(st > resmB){
        var offsetValResm = (st - resmB);
        var transVal = ((offsetValResm / blankHeight)*2)*75;

        img_section_3.css("transform", 'matrix(1, 0, 0, 1, 0, '+ -transVal+ ')');
      }
      // console.log(content_about.offset().top, st);

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