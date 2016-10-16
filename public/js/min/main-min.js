function fromToClass(e,i,s){e.hasClass(i)&&(e.addClass(s),e.removeClass(i))}function switchClass(e,i,s){e.hasClass(i)?(e.addClass(s),e.removeClass(i)):e.hasClass(s)&&(e.addClass(i),e.removeClass(s))}function setDialog(e){$("[class*='js-dialog-']").each(function(){fromToClass($(this),"is-visible","is-hidden")}),fromToClass($(".js-dialog-"+e),"is-hidden","is-visible")}function setVariables(e){var i=e,s=i.closest("[id*='f-main-fieldset-']").find("[class*='js-fieldset-']"),t=i.closest("[id*='f-main-fieldset-']").attr("id");fieldsetCount=0,s.each(function(){$(this).hasClass("is-visible")&&fieldsetCount++}),/\bcontact\b/gi.test(t)?(maxFieldsetAllowed=2,minFieldsetAllowed=1,setDialog("contact")):/\bhours\b/gi.test(t)?(maxFieldsetAllowed=7,minFieldsetAllowed=1,setDialog("hours")):/\bcompetitors\b/gi.test(t)?(maxFieldsetAllowed=6,minFieldsetAllowed=1,setDialog("competitors")):/\blike\b/gi.test(t)||/\bdislike\b/gi.test(t)?(maxFieldsetAllowed=4,minFieldsetAllowed=2,setDialog("weblist")):/\bdomain\b/gi.test(t)&&(maxFieldsetAllowed=6,minFieldsetAllowed=1,setDialog("domain"))}function btnCheck(e){var i=e,s=i.closest(".js-f-main-fieldset").find(".js-btn-show"),t=i.closest(".js-f-main-fieldset").find(".js-btn-hide");setVariables(i),fieldsetCount==minFieldsetAllowed?(fromToClass(s,"is-deactivated","is-activated"),fromToClass(t,"is-activated","is-deactivated"),fromToClass(s,"is-hidden","is-visible"),fromToClass(t,"is-visible","is-hidden"),fromToClass(s,"is-disabled","is-active"),fromToClass(t,"is-active","is-disabled")):fieldsetCount==maxFieldsetAllowed?(fromToClass(s,"is-activated","is-deactivated"),fromToClass(t,"is-deactivated","is-activated"),fromToClass(s,"is-visible","is-hidden"),fromToClass(t,"is-hidden","is-visible"),fromToClass(s,"is-active","is-disabled"),fromToClass(t,"is-disabled","is-active")):(fromToClass(s,"is-deactivated","is-activated"),fromToClass(t,"is-deactivated","is-activated"),fromToClass(s,"is-hidden","is-visible"),fromToClass(t,"is-hidden","is-visible"),fromToClass(s,"is-disabled","is-active"),fromToClass(t,"is-disabled","is-active"))}function removeField(){var e=removeClicked,i=e.closest(".js-f-main-fieldset").find(".js-btn-show"),s=e.closest(".js-f-main-fieldset").find(".js-btn-hide");fromToClass(e,"is-visible","is-hidden"),btnCheck(e);var t=0;e.find("input, textarea").each(function(){$(this).val(""),"email"==$(this).attr("type")&&0==t&&(emailVerification($(this)),t++)}),""!=e.find("select").first().val()&&e.find("select").first().val("")}function overlay(e){el=document.getElementById("overlay"),el.style.visibility="visible"==el.style.visibility?"hidden":"visible",elb=document.getElementById("f-container"),elb.style.webkitFilter="blur(3px)"==elb.style.webkitFilter?"blur(0px)":"blur(3px)";var i=$("#overlay-container");if(switchClass(i,"spring-in","spring-out"),"undefined"!=typeof e){var s=e;return s=s.getAttribute("value"),1==s?void("sameas"==modalDecision?replaceInfo():"fields"==modalDecision&&removeField()):void("sameas"==modalDecision&&$("#f-sameas-primary").attr("checked",!1))}}function addFieldsets(e){var i=e;if(i.hasClass("js-btn-show")){var s=i.closest(".js-f-main-fieldset").find("[class*='js-fieldset-']");s.each(function(){var e=$(this);if(e.hasClass("is-hidden"))return fromToClass(e,"is-hidden","is-visible"),btnCheck(e),!1})}else if(i.hasClass("js-btn-hide")){var s=i.closest(".js-f-main-fieldset").find("[class*='js-fieldset-']"),t=0;$(s.get().reverse()).each(function(){var e=$(this),i=e.find("input:not([type='radio'],[type='checkbox'])");if(e.hasClass("is-visible")&&!e.hasClass("js-fieldset-1")&&!e.hasClass("js-fieldset-lock"))return removeClicked=e,e.find(".js-hours-block").length>0?(0!=e.find(".js-hours-block select option").filter(":selected").val().length?(modalDecision="fields",overlay()):removeField(),!1):i.length>0?0!=i.val().length?(modalDecision="fields",overlay(),!1):(removeField(),!1):(modalDecision="fields",overlay(),!1)})}}function eMatch(e,i){var s="js-match"==i?"js-no-match":"js-match";e.find("input").each(function(){var e=$(this);fromToClass(e,s,i),e.hasClass(i)||e.addClass(i)})}function eCheck(e){e?(eMatch(parentSection,"js-match"),fromToClass(thisHint,"js-hint-no-match","js-hint-match"),fromToClass(thisHint,"fa-exclamation-triangle","fa-check")):(eMatch(parentSection,"js-no-match"),fromToClass(thisHint,"js-hint-match","js-hint-no-match"),fromToClass(thisHint,"fa-check","fa-exclamation-triangle"))}function emailVerification(e){thisSelector=e,parentSection=thisSelector.parents(".js-fieldset-email"),thisValue=thisSelector.val(),thisHint=parentSection.find(".fa"),emailCheck=thisSelector[0].checkValidity(),emailContent=thisSelector.val(),validationField=parentSection.find(".js-email-validation"),validationValue=validationField.find("input"),emailMatch=thisValue===validationValue.val(),emailCheck&&0!=thisValue.length&&0==validationValue.val().length?(eMatch(parentSection,"js-no-match"),thisValue.length>=6&&fromToClass(validationField,"is-hidden","is-visible")):emailCheck&&0!=thisValue&&validationValue.val().length>0?(eCheck(emailMatch),thisValue.length>=6&&fromToClass(validationField,"is-hidden","is-visible")):(fromToClass(validationField,"is-visible","is-hidden"),thisValue.length<6&&validationValue.val(""),parentSection.find("input").each(function(){var e=$(this);e.hasClass("js-no-match")&&e.removeClass("js-no-match"),e.hasClass("error")&&e.removeClass("error")}))}function emailValidation(e){thisSelector=e,parentSection=thisSelector.parents(".js-fieldset-email"),thisValue=thisSelector.val(),thisHint=parentSection.find(".fa"),verificationField=parentSection.find(".js-email-verification"),verificationValue=verificationField.find("input").val(),emailCheck=thisSelector[0].checkValidity(),emailContent=thisSelector.val(),emailMatch=thisValue===verificationValue,eCheck(emailMatch)}function replaceInfo(){to_fn.val(fr_fn.val()),to_fn.focusout(),to_ln.val(fr_ln.val()),to_ln.focusout(),to_ph.val(fr_ph.val()),to_ph.focusout(),to_email.val(fr_email.val()),to_email.focusout(),""!=fr_email.val()&&(emailVerification(to_email),""!=fr_emailValid.val()&&(to_emailValid.val(fr_emailValid.val()),to_emailValid.focusout(),emailValidation(to_emailValid))),to_fn.parents(".js-f-main-fieldset").find("input").each(function(){if(""==$(this).val())return $(this).focus(),!1})}function btnVisibility(e){var i=e;"confirm"===i?(fromToClass(bAlert,"is-visible","is-hidden"),fromToClass(bAccept,"is-hidden","is-visible"),fromToClass(bDecline,"is-hidden","is-visible")):"alert"===i&&(fromToClass(bAlert,"is-hidden","is-visible"),fromToClass(bAccept,"is-visible","is-hidden"),fromToClass(bDecline,"is-visible","is-hidden"))}function toggleArea(e){function i(e){e.each(function(){$(this).attr("checked",!1),$(this).hasClass("js-other-details")&&toggleArea($(this))})}var s=e,t=s.attr("type"),a,l;if(a=s.parent().find(".js-toggle-area"),"radio"==t&&s.hasClass("js-other-details"))theTextArea=s.parent().find("textarea"),l=s.parent().siblings("div").find("textarea"),l.each(function(){fromToClass($(this),"is-visible","is-hidden"),0!=$(this).val()&&$(this).val("")}),s.is(":checked")&&0!=theTextArea.length&&(fromToClass(theTextArea,"is-hidden","is-visible"),theTextArea.focus());else if("radio"==t)l=s.parent().siblings("div").find(".js-toggle-area"),s.is(":checked")&&0!=a.length?(l.each(function(){fromToClass($(this),"is-visible","is-hidden"),$(this).find("input, textarea").each(function(){i($(this))})}),fromToClass(a,"is-hidden","is-visible"),a.find(".m-odtext")&&a.find(".m-odtext").first().find("textarea").focus()):s.is(":checked")&&0!=l.length,l.each(function(){fromToClass($(this),"is-visible","is-hidden"),$(this).find("input, textarea").each(function(){i($(this))})});else if("checkbox"==t&&0!=a.length)s.is(":checked")?fromToClass(a,"is-hidden","is-visible"):(fromToClass(a,"is-visible","is-hidden"),i(a.find("input")));else if("checkbox"==t&&s.hasClass("js-other-details"))theTextArea=s.parent().find("textarea"),s.is(":checked")?(fromToClass(theTextArea,"is-hidden","is-visible"),theTextArea.focus()):(fromToClass(theTextArea,"is-visible","is-hidden"),0!=theTextArea.val()&&theTextArea.val(""));else if("checkbox"==t&&s.hasClass("js-hours-closed")){var n=s.parents("[class*='js-fieldset-']").find("select");s.is(":checked")&&n.each(function(){0!=$(this).find(".js-opt-closed").length&&($(this).find(".js-opt-closed").prop("selected",!0),$(this).find(".js-opt-closed").change())})}}function setWindowDimension(){"undefined"!=typeof window.innerWidth&&(vw=window.innerWidth,vh=window.innerHeight)}function setViewportScale(){if(vw<1050){var e;e=document.getElementsByName("viewport"),e[0].setAttribute("content","width=device-width, initial-scale=1, maximum-scale=1")}}function jsMediaQ(){function e(e){i.className=t+" "+e}var i=document.getElementsByTagName("body")[0],s=/(th-dark|th-light)/i,t=s.exec(i.className)[0];e(vw>=vwDesktop?"js-desktop":vw>=vwLaptop?"js-laptop":vw>=vwTablet?"js-tablet":vw>=vwPhablet?"js-phablet":"js-mobile")}function viewportIni(){setWindowDimension(),setViewportScale(),jsMediaQ(),animPosition=vh*heightTrigger,st=vh*ps,nd=vh*pe}var vh,vw,scrollPostion,heightTrigger=.4,animPosition,ps=1-heightTrigger+.2,pe=1-heightTrigger-.2,st,nd,vwDesktop=1440,vwLaptop=1024,vwTablet=768,vwPhablet=600,confirmBoxType="confirm",removeClicked,fieldsetCount,fieldsetName,minFieldsetAllowed,maxFieldsetAllowed,modalDecision,bAlert,bAccept,bDecline,validationField,validationValue,emailMatch,thisValue,parentSection,thisSelector,thisHint,to_fn,to_ln,to_ph,to_email,to_emailValid,fr_fn,fr_ln,fr_ph,fr_email,fr_emailValid,fromFields=[],toFields=[],theTextArea;!function(){viewportIni(),window.attachEvent?window.attachEvent("onresize",function(){viewportIni()}):window.addEventListener?window.addEventListener("resize",function(){viewportIni()},!0):viewportIni()}(),$(document).ready(function(){function e(){$("body").hasClass("th-light")?$(".js-menu-theme").children().addClass("fa-moon-o"):$("body").hasClass("th-dark")&&$(".js-menu-theme").children().addClass("fa-sun-o")}function i(e){var i=new RegExp("(?:^"+e+"|;s*"+e+")=(.*?)(?:;|$)","g"),s=i.exec(document.cookie);return null===s?null:s[1]}function s(e){var i=e.find("input");e.trigger("reset"),i.each(function(){$(this).val(""),$(this).focus()}),i.last().blur()}function t(e){$("#captcha").length&&grecaptcha.reset(),s(e),$(document).scrollTop(e.offset().top)}function a(e,i){var t=e,a=$.parseJSON(i);a.modal&&alert(a.data),a.reset&&($("#captcha").length&&grecaptcha.reset(),s(t)),a.transfer?window.location.href=a.location+"?transferData="+a.transferData:a.redirect?window.location.href=a.location:($("#js-form-output").html("<span>"+a.data+"</span>"),$(document).scrollTop(t.offset().top))}bAlert=$(".m-alert"),bAccept=$(".m-accept"),bDecline=$(".m-decline"),fr_fn=$("#f-contact-firstname-1"),fr_ln=$("#f-contact-lastname-1"),fr_ph=$("#f-contact-phone-1"),fr_email=$("#f-contact-email-verification-1"),fr_emailValid=$("#f-contact-email-validator-1"),to_fn=$("#f-billing-fn"),to_ln=$("#f-billing-ln"),to_ph=$("#f-billing-phone"),to_email=$("#f-billing-email-verification"),to_emailValid=$("#f-billing-email-validator"),fromFields=[fr_fn,fr_ln,fr_ph,fr_email,fr_emailValid],toFields=[to_fn,to_ln,to_ph,to_email,to_emailValid],$(".m-hero").length&&($(".m-coname").hasClass("js-home")||$(".m-coname").addClass("js-home"),$(".m-nav-login").hasClass("js-home")||$(".m-nav-login").addClass("js-home")),$divider=$(".th-divider"),$divider.length&&$divider.first().addClass("animate"),$(".m-mobile-menu").click(function(){var e=$(this).children();e.hasClass("fa-bars")?(e.addClass("fa-times"),e.removeClass("fa-bars")):e.hasClass("fa-times")&&(e.addClass("fa-bars"),e.removeClass("fa-times"));var i=$(this).siblings(".m-menu");i.is(":visible")?i.slideUp():i.slideDown()}),$(".m-menu-li-drop").click(function(){function e(e){var i=e;i.is(":hover")&&!s?i.mouseleave(function(){var e=$(this);e.hasClass("js-mouseleave")||e.addClass("js-mouseleave"),fromToClass(e,"is-toggled","is-not-toggled"),fromToClass(e.children("ul"),"is-toggled","is-not-toggled")}):(fromToClass(i,"is-toggled","is-not-toggled"),fromToClass(i.children("ul"),"is-toggled","is-not-toggled"))}var i=$(this),s=Modernizr.touch;i.hasClass("js-mouseleave")&&(i.removeClass("js-mouseleave"),i.unbind("mouseleave")),switchClass(i,"is-not-toggled","is-toggled"),switchClass(i.children("ul"),"is-toggled","is-not-toggled"),setTimeout(function(){e(i)},3e3)}),$(".js-menu-theme").click(function(){var e=$("body"),i=$(".js-menu-theme"),s="theme",t,a=30;switchClass(i.children(),"fa-sun-o","fa-moon-o"),switchClass(e,"th-dark","th-light"),e.hasClass("th-dark")?(t="th-dark",$("#captcha").length&&grecaptcha.reset(widgetId1,{sitekey:"6LfS5ggTAAAAAERF8SrqqTaWKt4nYpvh0nCwiEmT",theme:"dark"})):(t="th-light",$("#captcha").length&&grecaptcha.reset(widgetId1,{sitekey:"6LfS5ggTAAAAAERF8SrqqTaWKt4nYpvh0nCwiEmT",theme:"light"}));var l=new Date;if(l.setDate(l.getDate()+a),document.cookie=s+"="+escape(t)+";expires="+l.toGMTString(),$(".m-mobile-menu").is(":visible")){var n=$(".m-mobile-menu").children();$(".m-menu").is(":visible")&&$(".m-menu").slideUp(),n.hasClass("fa-bars")?(n.addClass("fa-times"),n.removeClass("fa-bars")):n.hasClass("fa-times")&&(n.addClass("fa-bars"),n.removeClass("fa-times"))}}),$("textarea").autogrow({onInitialize:!0}),$("[type='text'], [type='password'], [type='email'], [type='url'], [type='tel'], textarea").focusout(function(){var e=$(this);""!=e.val()?e.hasClass("has-value")||e.addClass("has-value"):e.hasClass("has-value")&&e.removeClass("has-value")}),$("[class*='js-btn-']").click(function(){addFieldsets($(this))}),$("[id*='-email-verification']").keyup(function(){emailVerification($(this))}),$("[id*='-email-validator']").keyup(function(){emailValidation($(this))}),$("#f-sameas-primary").change(function(){$(this).is(":checked")&&(""!=to_fn.val()||""!=to_ln.val()||""!=to_ph.val()||""!=to_email.val()?""!=fr_fn.val()||""!=fr_ln.val()||""!=fr_ph.val()||""!=fr_email.val()?(setDialog("primary"),confirmBoxType="confirm",modalDecision="sameas",btnVisibility(confirmBoxType),overlay()):(setDialog("noprimary"),confirmBoxType="alert",modalDecision="alert",btnVisibility(confirmBoxType),overlay(),$(this).attr("checked",!1)):""!=fr_fn.val()||""!=fr_ln.val()||""!=fr_ph.val()||""!=fr_email.val()?replaceInfo():(setDialog("noprimary"),confirmBoxType="alert",modalDecision="alert",btnVisibility(confirmBoxType),overlay(),$(this).attr("checked",!1)))}),$(".js-fieldset-1").find("[id*='f-contact']").keyup(function(){if($("#f-sameas-primary").is(":checked"))for(var e=0,i=toFields.length;e<i;e++)fromFields[e].val()!==toFields[e].val()&&(toFields[e].val(fromFields[e].val()),toFields[e]==to_email?emailVerification(toFields[e]):toFields[e]==to_emailValid&&emailValidation(toFields[e]))}),$(".js-f-main-fieldset").find("[id*='f-billing']").keyup(function(){if($("#f-sameas-primary").is(":checked"))for(var e=0,i=toFields.length;e<i;e++)fromFields[e].val()!==toFields[e].val()&&$("#f-sameas-primary").attr("checked",!1)}),$("[type='tel']").keyup(function(){var e=$(this),i=e.val();/^\((\b\d{3}\b)\) (\b\d{4}\b)$/g.test(i)?e.val(i.substring(0,i.length-1)+"-"+i.charAt(i.length-1)):/^\((\b\d{3}\b)\)\d$/g.test(i)?e.val(i.substring(0,i.length-1)+" "+i.charAt(i.length-1)):/^(\b\d{3}\b)$/g.test(i)&&e.val("("+i+")")}),$("select").change(function(e){var i=$(this),s=i.find("option:selected").val();""!=s?i.hasClass("has-selection")||i.addClass("has-selection"):(console.log("i have NO selection"),i.hasClass("has-selection")&&i.removeClass("has-selection"))}),$("[type='radio']").change(function(e){toggleArea($(this))}),$("[type='checkbox']").change(function(e){toggleArea($(this))}),$("[id*='f-hours']").change(function(){var e=$(this).closest("[class*='js-fieldset-']").find(".js-hours-closed"),i=$(this).closest("[class*='js-fieldset-']").find(".js-opt-closed:checked").length;e.is(":checked")&&3===i?e.prop("checked",!1):e.is(":checked")||4!==i||e.prop("checked",!0)}),$(".m-block-info").hide(),$(".js-toggle-info").click(function(e){var i=$(this).parent().parent(".m-inquiry-block"),s=i.find(".m-block-info").first(),t=s.find("blockquote").first();e.preventDefault(),i.toggleClass("toggle-on"),s.is(":visible")?(t.hasClass("animate")&&t.removeClass("animate"),s.slideToggle(100,"swing")):s.slideToggle(200,"swing",function(){t.hasClass("animate")||t.addClass("animate")})}),$(function(){$("a[href*=#]:not([href=#])").click(function(){if(location.pathname.replace(/^\//,"")==this.pathname.replace(/^\//,"")&&location.hostname==this.hostname){var e=$(this.hash);e=e.length?e:$("[id="+this.hash.slice(1)+"]");var i=e.attr("id"),s=$("#"+i);if(console.log(i),e.length)return $("html,body").animate({scrollTop:e.offset().top-50},500,function(){s.addClass("js-anim-bg"),setTimeout(function(){s.removeClass("js-anim-bg")},2e3)}),!1}})});var l=1;if($("input, textarea, select").each(function(){$(this).attr("tabindex",l),l++}),$("#f-submit").attr("tabindex",l),l++,$("#f-reset").attr("tabindex",l),l++,$("[type='reset']").click(function(){var e=$("form").offset().top;document.body.scrollTop=document.documentElement.scrollTop=e,document.location.reload()}),$(".js-profile-changebtn, .js-profile-cancelbtn").click(function(e){e.preventDefault();var i=$(this).parents(".row").find("form"),s=$(this).parents(".row").find(".js-result"),t=$(this).parents(".row").find(".js-result span");$(this).hasClass("js-profile-changebtn")&&s.hasClass("is-visible")&&(s.removeClass("is-visible"),s.addClass("is-hidden"),t.text(""));var a=$(this).parents(".row").siblings(".row").find("form");a.is(":visible")&&(a.addClass("is-hidden"),a.removeClass("is-visible"),a.trigger("reset")),i.is(":visible")?(i.addClass("is-hidden"),i.removeClass("is-visible")):(i.removeClass("is-hidden"),i.addClass("is-visible"),i.trigger("reset"))}),e(),"fr_CA"==i("lang"))var n="Échec de connection",o="Échec de l'enregistrement",r="Échec de la réinitialisation du courriel",d="Échec du changement de nom",c="Échec du changement de courriel",h="Échec du changement de password",f="Le mot de passe doit être compter au moins 6 caractères, mais pas plus de 20. Il doit avoir au moins une minuscule, une majuscule et un caractère numérique. Seuls les caractères spéciaux suivants sont valide @*_-!.",m="Les noms doivent contenir que des lettres, des espaces et des tirets.",u="Doit contenir uniquement des caractères alphabétique",v="Doit contenir au moins 1 caractère numérique",p="Doit contenir au moins 1 caractère alphabétique minuscule",g="Doit contenir au moins 1 caractère alphabétique majuscule",b="Confirmation du courriel invalide",C="Confirmation du mot de passe invalide",w="Le mot de passe doit être compter au moins 6 caractères, mais pas plus de 20. Il doit avoir au moins une minuscule, une majuscule et un caractère numérique. Seuls les caractères spéciaux suivants sont valide @*_-!.";else var n="Sign in Failed",o="Registration Failed",r="Password Reset Failed",d="Name Change Failed",c="Email Change Failed",h="Password Change Failed",f="The password must at least 6 characters long but no more then 20. It must have at least one lower-case, one upper-case and one digit character. Only the following special characters are supported @*_-!.",m="Names must contain only letters, space and dashes.",u="Must contain only letter characters",v="Must contain at least 1 digit character",p="Must contain at least 1 lower-case character",g="Must contain at least 1 upper-case character",b="Email Confirmation Mismatch",C="Password Confirmation Mismatch",w="The password must at least 6 characters long but no more then 20. It must have at least one lower-case, one upper-case and one digit character. Only the following special characters are supported @*_-!.";$.validator.addMethod("pwdCheck",function(e){return/^[A-Za-z0-9\d=!\-@._*]*$/.test(e)&&/[a-z]/.test(e)&&/[A-Z]/.test(e)&&/\d/.test(e)},f),$.validator.addMethod("nameCheck",function(e){return/^[a-zA-ZàèìòùÀÈÌÒÙáéíóúýÁÉÍÓÚÝâêîôûÂÊÎÔÛãñõÃÑÕäëïöüÿÄËÏÖÜŸçÇßØøÅåÆæœ\s\-]+$/.test(e)},m),$.validator.addMethod("alphaCheck",function(e){return/^[a-zA-Z]+$/.test(e)},u),$.validator.addMethod("digitCheck",function(e){return/\d/.test(e)},v),$.validator.addMethod("lowerCheck",function(e){return/[a-z]/.test(e)},p),$.validator.addMethod("upperCheck",function(e){return/[A-Z]/.test(e)},g),$.validator.addMethod("confirmMail",$.validator.methods.equalTo,b),$.validator.addMethod("confirmPsw",$.validator.methods.equalTo,C),$.validator.addMethod("rangePsw",$.validator.methods.rangelength,w);var j=$("#projecklist");j.validate({submitHandler:function(e){$.post("projeckt.php",j.serialize(),function(e){"SUCCESS"===e?$("#results").html(e):$("#results").html(e)})}});var k=$("#login");k.validate({submitHandler:function(e){$.post("login.php",k.serialize()).done(function(e){a(k,e)}).fail(function(){$("#js-form-output").html("<span>"+n+"</span>"),t(k)})}});var T=$("#register");T.validate({rules:{fld_register_email_confirm:{confirmMail:"#f-register-email"},fld_register_fn:{nameCheck:!0},fld_register_ln:{nameCheck:!0},fld_register_psw:{pwdCheck:!0,rangePsw:[6,20]},fld_register_psw_confirm:{confirmPsw:"#f-register-password"}},submitHandler:function(e){$.post("register.php",T.serialize()).done(function(e){a(T,e)}).fail(function(){$("#js-form-output").html("<span>"+o+"</span>"),t(T)})}});var _=$("#forgot");_.validate({submitHandler:function(e){$.post("forgot.php",_.serialize()).done(function(e){a(_,e)}).fail(function(){$("#js-form-output").html("<span>"+r+"</span>"),t(_)})}});var y=$("#profile-name");y.validate({rules:{fld_profile_fn:{nameCheck:!0},fld_profile_ln:{nameCheck:!0}},submitHandler:function(e){$.post("profile.php",y.serialize()).done(function(e){var i=$.parseJSON(e),s=i.status;s&&($(".js-profile-fn").text(i.firstname),$(".js-profile-ln").text(i.lastname),$("#f-profile-fn").attr("value",i.firstname),$("#f-profile-ln").attr("value",i.lastname),$("#js-display-name").text(i.firstname)),y.is(":visible")&&(y.addClass("is-hidden"),y.removeClass("is-visible")),$("#js-result-name").is(":visible")||($("#js-result-name span").text(i.data),$("#js-result-name").removeClass("is-hidden"),$("#js-result-name").addClass("is-visible")),y.trigger("reset")}).fail(function(){$("#js-form-output").html("<span>"+d+"</span>"),s(y)})}});var x=$("#profile-email");x.validate({rules:{fld_profile_email_confirm:{confirmMail:"#f-profile-email"}},submitHandler:function(e){$.post("profile.php",x.serialize()).done(function(e){var i=$.parseJSON(e),s=i.status;s&&$(".js-profile-email").text(i.email),x.is(":visible")&&(x.addClass("is-hidden"),x.removeClass("is-visible")),$("#js-result-email").is(":visible")||($("#js-result-email span").text(i.data),$("#js-result-email").removeClass("is-hidden"),$("#js-result-email").addClass("is-visible")),x.trigger("reset")}).fail(function(){$("#js-form-output").html("<span>"+c+"</span>"),s(x)})}});var A=$("#profile-password");A.validate({rules:{fld_profile_new_psw:{pwdCheck:!0,rangePsw:[6,20]}},submitHandler:function(e){$.post("profile.php",A.serialize()).done(function(e){var i=$.parseJSON(e);A.is(":visible")&&(A.addClass("is-hidden"),A.removeClass("is-visible")),$("#js-result-password").is(":visible")||($("#js-result-password span").text(i.data),$("#js-result-password").removeClass("is-hidden"),$("#js-result-password").addClass("is-visible")),A.trigger("reset")}).fail(function(){$("#js-form-output").html("<span>"+h+"</span>"),s(A)})}}),$("#f-debug-fill-form").click(function(){$(".js-btn-show").each(function(){$(this).trigger("click")}),$($("[type='radio']").get().reverse()).each(function(){$(this).prop("checked",!0),toggleArea($(this))}),$("select").each(function(){function e(e,i){return Math.floor(Math.random()*(i-e+1))+e}var i=$(this);if(!i.parents("[class*='js-fieldset']").hasClass("is-hidden")){var s=$(this).find("option").length,t=3;t=i.parent().hasClass("m-range")?e(3,7):e(2,s-1),i.find("option:nth-of-type("+t+")").prop("selected",!0)}}),$("input").each(function(){var e=$(this),i=!e.parents("[class*='js-fieldset']").hasClass("is-hidden");switch(e.attr("type")){case"checkbox":i&&"f-hours-set-closed-1"!=e.attr("id")&&(e.prop("checked",!0),toggleArea(e));break;case"text":i&&(/\bpostal\b/gi.test(e.attr("id"))?(e.val("A0A 0A0"),e.keyup()):/\bfirstname\b/gi.test(e.attr("id"))?(e.val("John"),e.keyup()):/\blastname\b/gi.test(e.attr("id"))?(e.val("Doe"),e.keyup()):/\bproject\b/gi.test(e.attr("id"))?(e.val("XXXX's website"),e.keyup()):(e.val("Single line text value here"),e.keyup()));break;case"tel":i&&(e.val("(514) 575-4414"),e.keyup());break;case"email":i&&(e.val("idaniel.racine@gmail.com"),e.keyup())}}),$("textarea").each(function(){var e=$(this);e.parents("[class*='js-fieldset']").hasClass("is-hidden")||e.hasClass("is-hidden")||"g-recaptcha-response"===$(this).attr("name")||(e.val("First line od text\nSecond line of text"),e.keyup())}),$("#f-submit").focus(),$("html, body").animate({scrollTop:$("#f-submit").offset().top-vh/2},500)}),$(".js-ico-debug").click(function(){var e=$(this),i=e.parent().find(".m-ico-container"),s=e.parent().find(".m-ico-wrapper"),t=e.parent().find(".m-ico-module"),a=e.parent().find(".m-ico-label");i.toggleClass("m-ico-debug"),s.toggleClass("m-ico-debug"),t.toggleClass("m-ico-debug"),a.each(function(){$(this).toggleClass("m-ico-debug")})})}),$(window).scroll(function(){function e(e){var i=e.find(".m-ico-wrapper");switch(0!==d){case 1==d:c+=300;break;case 2==d:c+=200;break;case 3==d:c+=100;break;default:c=0}d++,setTimeout(function(){i.hasClass("js-in-view")||i.addClass("js-in-view")},c)}scrollPostion=$(document).scrollTop();var i=$(".section-action");if(i.length){var s=i.offset().top+i.height()/2;if(scrollPostion>s){var t=$(".m-float-radial .js-menu-theme");t.is(":visible")||t.show()}else{var t=$(".m-float-radial .js-menu-theme");t.is(":visible")&&t.hide()}}var a=$(".js-hint");if(a.length&&!a.hasClass("anim-buzz")){var l=a.offset().top;scrollPostion>l-st&&scrollPostion<l-nd&&a.each(function(){var e=$(this);verge.inY(e,-animPosition)&&e.addClass("anim-buzz")})}var n=$(".js-action-first");if(n.length&&vw>=vwTablet&&!n.hasClass("anim-lock")){var o=n.offset().top;if(scrollPostion>o-st&&scrollPostion<o-nd&&verge.inY(n,-animPosition)){n.addClass("anim-lock");var r=$("[class*='js-action']"),d=1,c=0;r.each(function(){e($(this))})}}vw<vwTablet&&scrollPostion<2e3&&$(".m-ico-square").each(function(){var e=$(this),i=e.find(".m-ico-wrapper");i.hasClass("js-in-view")||verge.inY(e,-animPosition)&&i.addClass("js-in-view")}),$(".th-divider").each(function(){thisSection=$(this);var e=thisSection.offset().top-vh-200;scrollPostion>e&&!thisSection.hasClass("animate")&&thisSection.addClass("animate")})});