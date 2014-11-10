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
  $('.blank').css('bottom', -windowH);
  header.css('bottom', -windowH);

  var sections = $('section'), c = sections.length;
  var imgAry = [], contentAry = [], locateAry = [];
  
  for( var i = 0; i < c; i++){
    currentDiv = sections[i];
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
  });
  navBtns.click(function(e){
    var ha = this.hash;
    pageScroll(e,ha);

  })

  function pageScroll(e,hash){
    e.preventDefault();
    var theHash = $(hash).offset().top;
    $('html, body').animate({
         scrollTop: theHash
       }, 650, function(){
         window.location.hash = hash;
         
       });    
  }
  function magicScroll(images, content, locations){
    var st = $(window).scrollTop();
    var wh = $(window).height();
    var aboutScroll = st + wh;
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
    
    var img_section_home = $(images[0]),
        img_section_1 = $(images[1]),
        img_section_2 = $(images[2]),
        img_section_3 = $(images[3]);
   
    var content_about = $(contentAry[0]),
        content_proj = $(contentAry[1]),
        content_resum = $(contentAry[2]),
        content_contact = $(contentAry[3]);
    
    var aboutB = content_about.height(),
        projB = (content_proj.height() + content_about.offset().top)+350;
    
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
      // firstSec.css('background-position', 'center '+ -backPos +'px');
      // hero.css({"transform" : "translate(0px, "+ -translateVal +"px", "opacity": op});
      
      if( st > aboutB ){
        // var newSt = (st - wh) - 650;
        var newBackPos = ((st - wh)/10)-100;


        // console.log(x);
        var newSt = backPos - 100;
        var newSt2 = backPos2 - 120;
        // var newSt = 5;
        // console.log('new st: ' +newSt);
        // console.log('backPos');
        // var backPos3 = newSt/10;
        // console.log('new back: '+newSt + ' screen top: ' + st);
        // console.log(backPos3 + " : " + backPos);
        // console.log(st + " " + wh + " " + aboutB);
        img_section_1.css("transform", 'matrix(1, 0, 0, 1, 0, '+ -newBackPos + ')');
        // content_proj.css("transform", 'matrix(1, 0, 0, 1, 0, '+ -newSt2 + ')');
        // img_section_1.css('background-position', 'center '+ -backPos3 +'px');
      }
      if ( st > projB ){
        var newBackPos = ((st - (wh*1.5))/10)-100;
        // console.log('newBackPos');

        img_section_2.css("transform", 'matrix(1, 0, 0, 1, 0, '+ -newBackPos + ')');



      }
      // console.log(st);



  };

  $(window).scroll(function(){
  	magicScroll(imgAry, contentAry, locateAry);
  })


});