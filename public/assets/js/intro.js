function shakeError(e){$("#btn-login").fadeIn().text("Entrar"),$("."+e).removeClass("animate__fadeInUp").addClass("animate__shakeX"),setTimeout((()=>{$("."+e).removeClass("animate__shakeX")}),1e3)}$(".open_reset_password").click((function(){$("small.text-danger").text(""),$("input").removeClass("is-invalid")})),$(".close_reset_password").click((function(){$("small.text-danger").text(""),$("input").removeClass("is-invalid")})),$("#form_login").submit((async function(e){e.preventDefault(),$(".loading").removeClass("d-none"),$("small.text-warning").text("");let a=$(this).serializeArray();$("#btn-login").fadeIn().html("Validando<i class='fas fa-spinner fa-pulse'></i>");try{let e=await fetch("/logon",{method:"POST",headers:{"Content-Type":"application/json","X-CSRF-Token":a[0].value},body:JSON.stringify({login:a[1].value,password:a[2].value})}),t=await e.json();console.log("Status: ",e.status),shakeError("form-signin"),e.status,void 0===t.error&&e.status>200&&($("#btn-login").text("Entrar"),Swal.fire({title:"403 - Serviço indisponível!",html:"Informe em nossa<br> Central de Atendimento.",icon:"error",confirmButtonColor:"#208637",confirmButtonText:"Central de Atendimento",showCloseButton:!0,willClose:()=>{$(this)[0].reset()}}).then((e=>{e.isConfirmed&&window.open("https://api.whatsapp.com/send?phone=558000282309&text=Desejo%20falar%20com%20atendimento%20Windx!")}))),e.status>200&&(t.error.login&&$("small.login_error").text(t.error.login),t.error.password&&$("small.password_error").text(t.error.password),422!=e.status&&Swal.fire({title:t.error,text:"Confirme seus dados de acesso em nossa Central de Atendimento.",icon:"warning",confirmButtonColor:"#208637",confirmButtonText:"Central de Atendimento",showCloseButton:!0,willClose:()=>{$(this)[0].reset()}}).then((e=>{e.isConfirmed&&window.open("https://api.whatsapp.com/send?phone=558000282309&text=Desejo%20falar%20com%20atendimento%20Windx!")}))),200===e.status&&($("#container-logo").addClass("animate__animated animate__fadeOutUp"),$("#btn-contact").addClass("animate__animated animate__fadeOutRight"),$("#footer").addClass("animate__animated animate__fadeOutDown"),$(this)[0].reset(),$("#btn-login").text("Entrar"),$(".form-signin").removeClass("animate__fadeInUp").addClass("animate__fadeOutUpBig"),$(".loader").removeClass("d-none"),location.href="/home")}catch(e){}})),$(".toggle-password").click((function(){$(this).toggleClass("fa-eye fa-eye-slash");var e=$($(this).attr("toggle"));"password"==e.attr("type")?e.attr("type","text"):e.attr("type","password")})),$(".reload").click((function(){$(".captcha img").click(),$(this).addClass("fa-spin"),setTimeout((()=>{$(this).removeClass("fa-spin")}),800)})),setTimeout((()=>{$(".full-screen-splash").addClass("animate__animated animate__fadeOut_ animate__zoomOut d-none"),$(".logo-windx").removeClass("d-none").addClass("animate__animated animate__fadeInDown"),$(".form-signin").removeClass("d-none").addClass("animate__animated animate__fadeInUp"),$(".mastfoot").removeClass("d-none").addClass("animate__animated animate__fadeInUp"),$(".button-card-contact").removeClass("d-none").addClass("animate__animated animate__slideInRight")}),"3000");
