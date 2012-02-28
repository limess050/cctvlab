/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.dialog.add('colordialog',function(a){var b=CKEDITOR.dom.element,c=CKEDITOR.document,d=CKEDITOR.tools,e=a.lang.colordialog,f;function g(){return{type:'html',html:'&nbsp;'};};function h(){c.getById(w).removeStyle('background-color');f.getContentElement('picker','selectedColor').setValue('');};function i(y){if(!(y instanceof CKEDITOR.dom.event))y=new CKEDITOR.dom.event(y);var z=y.getTarget(),A;if(z.getName()=='a'&&(A=z.getChild(0).getHtml()))f.getContentElement('picker','selectedColor').setValue(A);};function j(y){if(!(y instanceof CKEDITOR.dom.event))y=y.data;var z=y.getTarget(),A;if(z.getName()=='a'&&(A=z.getChild(0).getHtml())){c.getById(u).setStyle('background-color',A);c.getById(v).setHtml(A);}};function k(){c.getById(u).removeStyle('background-color');c.getById(v).setHtml('&nbsp;');};var l=d.addFunction(k),m=i,n=CKEDITOR.tools.addFunction(m),o=j,p=k,q=CKEDITOR.tools.addFunction(function(y){y=new CKEDITOR.dom.event(y);var z=y.getTarget(),A,B,C=y.getKeystroke(),D=a.lang.dir=='rtl';switch(C){case 38:if(A=z.getParent().getParent().getPrevious()){B=A.getChild([z.getParent().getIndex(),0]);B.focus();p(y,z);o(y,B);}y.preventDefault();break;case 40:if(A=z.getParent().getParent().getNext()){B=A.getChild([z.getParent().getIndex(),0]);if(B&&B.type==1){B.focus();p(y,z);o(y,B);}}y.preventDefault();break;case 32:m(y);y.preventDefault();break;case D?37:39:if(A=z.getParent().getNext()){B=A.getChild(0);if(B.type==1){B.focus();p(y,z);o(y,B);y.preventDefault(true);}else p(null,z);}else if(A=z.getParent().getParent().getNext()){B=A.getChild([0,0]);if(B&&B.type==1){B.focus();p(y,z);o(y,B);y.preventDefault(true);}else p(null,z);}break;case D?39:37:if(A=z.getParent().getPrevious()){B=A.getChild(0);B.focus();p(y,z);o(y,B);y.preventDefault(true);}else if(A=z.getParent().getParent().getPrevious()){B=A.getLast().getChild(0);B.focus();p(y,z);o(y,B);y.preventDefault(true);}else p(null,z);break;default:return;}});function r(){var y=['00','33','66','99','cc','ff'];function z(E,F){for(var G=E;G<E+3;G++){var H=s.$.insertRow(-1);for(var I=F;I<F+3;I++)for(var J=0;J<6;J++)A(H,'#'+y[I]+y[J]+y[G]);}};function A(E,F){var G=new b(E.insertCell(-1));G.setAttribute('class','ColorCell');G.setStyle('background-color',F);G.setStyle('width','15px');G.setStyle('height','15px');var H=G.$.cellIndex+1+18*E.rowIndex;G.append(CKEDITOR.dom.element.createFromHtml('<a href="javascript: void(0);" role="option" aria-posinset="'+H+'"'+' aria-setsize="'+234+'"'+' style="cursor: pointer;display:block;width:100%;height:100% " title="'+CKEDITOR.tools.htmlEncode(F)+'"'+' onkeydown="CKEDITOR.tools.callFunction( '+q+', event, this )"'+' onclick="CKEDITOR.tools.callFunction('+n+', event, this ); return false;"'+' tabindex="-1"><span class="cke_voice_label">'+F+'</span>&nbsp;</a>',CKEDITOR.document));
};z(0,0);z(3,0);z(0,3);z(3,3);var B=s.$.insertRow(-1);for(var C=0;C<6;C++)A(B,'#'+y[C]+y[C]+y[C]);for(var D=0;D<12;D++)A(B,'#000000');};var s=new b('table');r();var t=function(y){return CKEDITOR.tools.getNextId()+'_'+y;},u=t('hicolor'),v=t('hicolortext'),w=t('selhicolor'),x=t('color_table_label');return{title:e.title,minWidth:360,minHeight:220,onLoad:function(){f=this;},contents:[{id:'picker',label:e.title,accessKey:'I',elements:[{type:'hbox',padding:0,widths:['70%','10%','30%'],children:[{type:'html',html:'<table role="listbox" aria-labelledby="'+x+'" onmouseout="CKEDITOR.tools.callFunction( '+l+' );">'+s.getHtml()+'</table>'+'<span id="'+x+'" class="cke_voice_label">'+e.options+'</span>',onLoad:function(){var y=CKEDITOR.document.getById(this.domId);y.on('mouseover',j);},focus:function(){var y=this.getElement().getElementsByTag('a').getItem(0);y.focus();}},g(),{type:'vbox',padding:0,widths:['70%','5%','25%'],children:[{type:'html',html:'<span>'+e.highlight+'</span>\t\t\t\t\t\t\t\t\t\t\t\t<div id="'+u+'" style="border: 1px solid; height: 74px; width: 74px;"></div>\t\t\t\t\t\t\t\t\t\t\t\t<div id="'+v+'">&nbsp;</div><span>'+e.selected+'</span>\t\t\t\t\t\t\t\t\t\t\t\t<div id="'+w+'" style="border: 1px solid; height: 20px; width: 74px;"></div>'},{type:'text',label:e.selected,labelStyle:'display:none',id:'selectedColor',style:'width: 74px',onChange:function(){try{c.getById(w).setStyle('background-color',this.getValue());}catch(y){h();}}},g(),{type:'button',id:'clear',style:'margin-top: 5px',label:e.clear,onClick:h}]}]}]}]};});
