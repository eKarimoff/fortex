// document.querySelector('#text').addEventListener('focusout',myText);
// document.querySelector('#password').addEventListener('focusout',myPass);

// document.querySelector('#btn').addEventListener('click',function(){
// myText();
// myPass();

// });
// function myText(){
//     let message, text;
//     let errElement = document.getElementById('text');
//     message = document.getElementById('err');
//     text = document.getElementById('text').value;


//     try{
//         if(text == ''){
//             errElement.classList.remove('valid');
//             errElement.classList.add('err');
//             throw   ' bo\'sh'
//         }
//         if(text.length <6){
//             errElement.classList.remove('valid');
//             errElement.classList.add('err');
//             throw   ' 6 tadan ko\'proq bo\'lishi kerak';
//         }
//         if(text.length > 0){
//             errElement.classList.remove('err');
//             errElement.classList.add('valid');
//             message.innerHTML = '';

//         }
//     } catch(e){
//         message.innerHTML = 'Qiymat' + e;
//     }

// }


// function myPass(){
//     let message, pass;
//     let errElement = document.getElementById('password');
//     message = document.getElementById('err');
//     pass = document.getElementById('password').value;


//     try{
//         if(pass == ''){
//             errElement.classList.remove('valid');
//             errElement.classList.add('err');
//             throw ' bo\'sh'
//         }
//         if(pass.length > 0){
//             errElement.classList.remove('err');
//             errElement.classList.add('valid');
//             message.innerHTML = '';

//         }
//     } catch(e){
//         message.innerHTML = 'Qiymat' + e;
//     }

// }

