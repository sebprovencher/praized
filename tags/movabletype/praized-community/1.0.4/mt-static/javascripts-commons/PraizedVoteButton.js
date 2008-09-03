/**
 * Praized Vote Button Generic, version 0.0.2
 * Copyright (c) 2008 PraizedMedia Inc.
 * Author: Francois Lafortune (flafortune[at]praizedmedia[dot]com)
 * Licensed under the Apache License, Version 2.0 http://www.apache.org/licenses/LICENSE-2.0
 */

/*0.0.1*/
( function() {
/* This makes sure our widget has a very unique name in the javascript netherworld and thus prevents colision */
;var appName = 'PraizedVoteButton_UID_';
for (var i = 0; i < 16; i++) {
  appName += String.fromCharCode( Math.floor( Math.random() * 26 ) + 97 );
};
/* Make appName an object */
window[appName] = {};
/* Assign shortcut for appName */
var $ = window[appName];
;$.dom = function(){
  return {
    hasClass: function(element,klass){
      return element.className.match(new RegExp('(\\s|^)'+klass+'(\\s|$)'))
    },
    addClass: function(element,klass){
      if(typeof klass != 'string'){
        while(klass.length> 0){
          var k = klass.shift();
          $.dom.addClass(element,k);
        }
      }
      if (!$.dom.hasClass(element,klass)) element.className += " "+klass;
    },
    removeClass: function(element,klass){
      if(typeof klass != 'string'){
        while(klass.length> 0){
          var k = klass.shift();
          $.dom.removeClass(element,k);
        }
      }
      if ($.dom.hasClass(element,klass)){
        var reg = new RegExp('(\\s|^)'+klass+'(\\s|$)');
        element.className=element.className.replace(reg,' ');
      }
    },
    getElementsByClass: function(searchClass,node,tag) {
      var classElements = new Array();
      if ( node == null )
      node = document;
      if ( tag == null )
      tag = '*';
      var els = node.getElementsByTagName(tag);
      var elsLen = els.length;
      var pattern = new RegExp("(^|\\\s)"+searchClass+"(\\\s|$)");
      for (i = 0, j = 0; i < elsLen; i++) {
        if ( pattern.test(els[i].className) ) {
          classElements[j] = els[i];
          j++;
        }
      }
      return classElements;
    },
    getStyle: function(el,styleProp){
       if(el.currentStyle){
          var y = el.currentStyle[styleProp];
       }else if(window.getComputedStyle){
          var y = document.defaultView.getComputedStyle(el,null).getPropertyValue(styleProp);
       };
       return y;
    }
  }
}();
;$.utils = function(){
   return {
      isTooBig: function(vb){
         var oFontSize = $.dom.getStyle(vb.elems.score,'font-size');
         if(!oFontSize) oFontSize = 'inherit';
         var oFontFam = $.dom.getStyle(vb.elems.score,'font-family');
          if(!oFontFam) oFontFam = 'sans-serif';
         var h = document.createElement('span');
         h.style.cssText = 'visiblity:hidden;font-family:'+oFontFam+';font-size:'+oFontSize
         var charLen = vb.elems.score.innerHTML.replace(/(<[^>]+>)|\s/g,"").length;
         var i;
         h.innerHTML = vb.elems.score.innerHTML;
         document.body.appendChild(h);
         var ret = (h.offsetWidth > 60);
         h.parentNode.removeChild(h)
         return ret
      },
      adjustMetrics: function(vb){
         while($.utils.isTooBig(vb)){
            var positivesSize = parseInt($.dom.getStyle(vb.elems.positives,'font-size'));
            vb.elems.positives.style.fontSize = (positivesSize*0.9)+'px';
            vb.elems.separator.style.fontSize = (positivesSize*0.75)+'px';         
            vb.elems.total.style.fontSize = (positivesSize*0.75)+'px';             
         };
      }
   }
}();
;$.ajax = function(){
  return {
    XMLHttpFactories: [
    	function () {return new XMLHttpRequest()},
    	function () {return new ActiveXObject("Msxml2.XMLHTTP")},
    	function () {return new ActiveXObject("Msxml3.XMLHTTP")},
    	function () {return new ActiveXObject("Microsoft.XMLHTTP")}
    ],
    sendRequest: function(url,callback,postData,arg){
      var req = $.ajax.createXMLHTTPObject();
      if (!req) return;
      var method = (postData) ? "POST" : "GET";
      req.open(method,url,true);
      req.setRequestHeader('User-Agent','XMLHTTP/1.0');
      if (postData){
        req.setRequestHeader('Content-type','application/x-www-form-urlencoded');
      }
      req.setRequestHeader('X-Requested-With','XMLHTTPRequest');

      req.onreadystatechange = function () {
        if (req.readyState != 4) {
          return;
        }else{
          if (req.status != 200 && req.status != 304) {
            throw(req.status);
          }
          if(arg){
            callback(req,arg);
          }else{
            callback(req);
          }
        }
      }
      if (req.readyState == 4) return;
      req.send(postData);
    },
    createXMLHTTPObject: function(){
      var xmlhttp = false;
      for (var i=0;i<$.ajax.XMLHttpFactories.length;i++) {
        try {
          xmlhttp = $.ajax.XMLHttpFactories[i]();
        }
        catch (e) {
          continue;
        }
        break;
      }
      return xmlhttp;
    }
  }
}();
;$.event = function(){
  return {
    add: function(obj, type, fn ){
      if ( obj.attachEvent ) {
        obj['e'+type+fn] = fn;
        obj[type+fn] = function(){obj['e'+type+fn]( window.event );}
        obj.attachEvent( 'on'+type, obj[type+fn] );
      } else{
        obj.addEventListener( type, fn, false );
      }
    },
    remove: function(){
      if ( obj.detachEvent ) {
        obj.detachEvent( 'on'+type, obj[type+fn] );
        obj[type+fn] = null;
      } else {
        obj.removeEventListener( type, fn, false );
      }
    }
  }
}();

;$.f = function(){
  return {
    init: function(){
            $.buttons = [];
      $.f.setupElements();
    },
    setupElements: function(){
      var voteButtons = $.dom.getElementsByClass('praized-vote-button');
      var vb;
      while(voteButtons.length > 0 ){
        vb = voteButtons.shift();
        $.f.setupButton(vb);        
      }
      if($.css){
        $.css.init();
      }
    },
    setupButton: function(voteButton){
      voteButton.elems = {
         score: $.dom.getElementsByClass('score',voteButton)[0],
        positives: $.dom.getElementsByClass('positives',voteButton)[0],
        total:     $.dom.getElementsByClass('total',voteButton)[0],
        separator:     $.dom.getElementsByClass('separator',voteButton)[0],
        vote_up:    $.dom.getElementsByClass('vote-for',voteButton)[0],
        vote_down:  $.dom.getElementsByClass('vote-against',voteButton)[0]
      };   
      $.utils.adjustMetrics(voteButton);
        voteButton.elems.vote_up.setAttribute('type','button')
        voteButton.elems.vote_down.setAttribute('type','button')
      voteButton.isLoading = function(){
        return $.dom.hasClass(voteButton,'loading');
      }
      voteButton.stopLoader = function(){
        $.dom.removeClass(voteButton,'loading');
      };
      voteButton.startLoader = function(){
        $.dom.addClass(voteButton,'loading');
      };
      voteButton.update = function(req,voted){
        try{
            eval('var obj = '+req.responseText);
       }catch(e){
            throw('could not evaluate json response')
            return;
        }
            if(obj.redirect_url && obj.redirect_url != null){
              return window.location.href=obj.redirect_url;
            }else if(obj.error || obj.errors){
              $.dom.removeClass(voteButton,'loading');
              $.dom.addClass(voteButton,'error');
              return;
            }
        $.dom.removeClass(voteButton,'novotes voted-pos voted-neg vote-1 vote-0 pos neg'.split(' '));
        voteButton.elems.positives.innerHTML = obj.pos_count;
        voteButton.elems.total.innerHTML = obj.count;
        $.dom.addClass(voteButton ,(voted > 0 ? 'voted-pos' : 'voted-neg'))
        voteButton.stopLoader();
        $.utils.adjustMetrics(voteButton);
      };
      voteButton.doVote = function(vote){
        var url = voteButton.getAttribute('action');
        $.ajax.sendRequest(url+'.json',voteButton.update,'vote='+vote,vote);
      }
      $.event.add(voteButton.elems.vote_up, 'click', function(e){
        if(!voteButton.isLoading()){
          voteButton.startLoader();
          if($.dom.hasClass(voteButton,'voted-pos')){
             voteButton.stopLoader();             
          }else{
             voteButton.doVote(1);             
          }
        }
        if (!e) var e = window.event
        e.cancelBubble = true;
        e.returnValue = false;
        if (e.stopPropagation) e.stopPropagation();
        if (e.preventDefault) e.preventDefault();
        
      });
      $.event.add(voteButton.elems.vote_down, 'click', function(e){
        if(!voteButton.isLoading()){
          voteButton.startLoader();
          if($.dom.hasClass(voteButton,'voted-neg')){
             voteButton.stopLoader();             
          }else{
             voteButton.doVote(0);      
          };
        };
        if (!e) var e = window.event;
        e.cancelBubble = true;
        e.returnValue = false;
        if (e.stopPropagation) e.stopPropagation();
        if (e.preventDefault) e.preventDefault();
      });
      $.buttons.push(voteButton);
     
    }
  };
}();
if (window.addEventListener) {
   window.addEventListener('load', function() { $.f.init(); }, false);
} else if (window.attachEvent) {
   window.attachEvent('onload', function() { $.f.init(); });
};
})();