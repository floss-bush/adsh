module("wysihtml5.dom.Sandbox",{teardown:function(){for(var a;a=document.querySelector("iframe.wysihtml5-sandbox");)a.parentNode.removeChild(a)},getCharset:function(a){a=a.characterSet||a.charset;return/unicode|utf-8/.test(a)?"utf-8":a},eval:function(a,c){try{return a.execScript?a.execScript(c):a.eval(c)}catch(b){return null}},isUnset:function(a,c){var b=this.eval(c,a);return!b||b==wysihtml5.EMPTY_FUNCTION}});
asyncTest("Basic Test",function(){expect(8);var a=new wysihtml5.dom.Sandbox(function(c){equal(c,a,"The parameter passed into the readyCallback is the sandbox instance");c=document.querySelectorAll("iframe.wysihtml5-sandbox");equal(c.length,1,"iFrame sandbox inserted into dom tree");c=c[c.length-1];ok(c.width==0&&c.height==0&&c.frameBorder==0,"iframe is not visible");var b=c.getAttribute("security")=="restricted";ok(b,"iFrame is sandboxed");b=a.getWindow().setInterval&&a.getWindow().clearInterval;
ok(b,"wysihtml5.Sandbox.prototype.getWindow() works properly");b=a.getDocument().appendChild&&a.getDocument().body;ok(b,"wysihtml5.Sandbox.prototype.getDocument() works properly");equal(a.getIframe(),c,"wysihtml5.Sandbox.prototype.getIframe() returns the iframe correctly");equal(typeof a.getWindow().onerror,"function","window.onerror is set");start()});a.insertInto(document.body)});
asyncTest("Security test #1",function(){expect(14);var a=this,c=new wysihtml5.dom.Sandbox(function(){var b=c.getWindow();wysihtml5.browser.USER_AGENT.indexOf("Safari")!==-1&&wysihtml5.browser.USER_AGENT.indexOf("Chrome")===1?ok(!0,"Cookie is NOT unset (but that's expected in Safari)"):ok(a.isUnset("document.cookie",b),"Cookie is unset");ok(a.isUnset("document.open",b),"document.open is unset");ok(a.isUnset("document.write",b),"document.write is unset");ok(a.isUnset("window.parent",b),"window.parent is unset");
ok(a.isUnset("window.opener",b),"window.opener is unset");ok(a.isUnset("window.localStorage",b),"localStorage is unset");ok(a.isUnset("window.globalStorage",b),"globalStorage is unset");ok(a.isUnset("window.XMLHttpRequest",b),"XMLHttpRequest is an empty function");ok(a.isUnset("window.XDomainRequest",b),"XDomainRequest is an empty function");ok(a.isUnset("window.alert",b),"alert is an empty function");ok(a.isUnset("window.prompt",b),"prompt is an empty function");ok(a.isUnset("window.openDatabase",
b),"window.openDatabase is unset");ok(a.isUnset("window.indexedDB",b),"window.indexedDB is unset");ok(a.isUnset("window.postMessage",b),"window.openDatabase is unset");start()});c.insertInto(document.body)});
asyncTest("Security test #2",function(){expect(2);var a=new wysihtml5.dom.Sandbox(function(){a.getDocument().body.innerHTML='<img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" onerror="#{script}" onload="try { window.parent._hackedCookie=document.cookie; } catch(e){}; try { window.parent._hackedVariable=1; } catch(e) {}">';setTimeout(function(){equal(window._hackedCookie||"","","Cookie can't be easily stolen");equal(window._hackedVariable||0,0,"iFrame has no access to parent");
start()},2E3)});a.insertInto(document.body)});asyncTest("Check charset & doctype",function(){expect(3);var a=this,c=new wysihtml5.dom.Sandbox(function(){var b=c.getDocument();ok(b.compatMode!="BackCompat","iFrame isn't in quirks mode");equal(a.getCharset(b),a.getCharset(document),"Charset correctly inherited by iframe");b.body.innerHTML='<meta charset="iso-8859-1">&uuml;';setTimeout(function(){equal(a.getCharset(b),a.getCharset(document),"Charset isn't overwritten");start()},500)});c.insertInto(document.body)});
asyncTest("Check insertion of single stylesheet",function(){expect(1);(new wysihtml5.dom.Sandbox(function(a){a=a.getDocument();equal(a.getElementsByTagName("link").length,1,"Correct amount of stylesheets inserted into the dom tree");start()},{stylesheets:"https://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/blitzer/jquery-ui.css"})).insertInto(document.body)});
asyncTest("Check insertion of multiple stylesheets",function(){expect(1);(new wysihtml5.dom.Sandbox(function(a){a=a.getDocument();equal(a.getElementsByTagName("link").length,2,"Correct amount of stylesheets inserted into the dom tree");start()},{stylesheets:["https://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/blitzer/jquery-ui.css","https://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/excite-bike/jquery-ui.css"]})).insertInto(document.body)});
asyncTest("Check X-UA-Compatible",function(){expect(1);(new wysihtml5.dom.Sandbox(function(a){a=a.getDocument();ok(a.documentMode===document.documentMode,"iFrame is in in the same document mode as the parent site");start()})).insertInto(document.body)});
