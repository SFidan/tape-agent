var app = new Vue({
    el: '#app',
    data: {
        rName: '',
        tape: '',
        yName: '',
        link: '',
        pass: '',
        step: 0,
        transitionName: 'left',

    },
    methods: {
        changeStep(direction){
            if (direction === 'next'){
                this.transitionName = 'left'
                this.step++
            }else{
                this.transitionName = 'right'
                this.step--;
            }
          },
        submit() {
            axios.post('insertData.php', {
                rName: this.rName,
                tape: this.tape,
                yName: this.yName,
                pass: this.pass,
                option: 'POST',
            }).then(function (response) {
                app.link = response.data.link;
                this.step++;
            })
        }
    },
})

var app2 = new Vue({
    el: '#app2',
    data: {
        fail: ''
    },
    beforeCreate: function(){
        axios.post('insertData.php', {
            link: '-123',
            option: 'RETRIEVE',
        }).then(function (response) {
            if (response.data == 'fail') {
                app2.fail = 1
            }else{
                app2.fail = 0
            }
        })      
    },
    methods: {
    },
})

// tapeRetrieve = () => {
//     $.ajax({
//         type: "POST",
//         url: 'insertData.php',
//         data: {
//             option: 'RETRIEVE',
//             link: "-30p1207zmanq"
//         },
//         success: function (response) {
//             var jsonData = JSON.parse(response);

//             if (jsonData.fail) {
//                 $('#errorMessage').fadeIn(500);
//             } else {
//                 $('#passEnter').fadeIn(500);
//                 tapeVerify(jsonData.link);
//             }
//         }
//     });
// };

// tapeVerify = (linkPara) => {
//     $('#passwordForm').submit(function (e) {
//         e.preventDefault();
//         var pass = app2.pass;
//         $.ajax({
//             type: "POST",
//             url: 'insertData.php',
//             data: {
//                 option: 'VERIFY',
//                 pass: pass,
//                 link: linkPara
//             },
//             success: function (response) {
//                 var jsonData = JSON.parse(response);
//                 if (jsonData.fail) {
//                     alert('Incorrect Password')
//                 } else {
//                     $('#passEnter').fadeOut(500, function () {
//                         $('#tapeShow').fadeIn(500);
//                     });
//                     app2.yName = jsonData.yName,
//                         app2.tape = jsonData.tape,
//                         app2.rName = jsonData.rName
//                 }
//             }
//         });
//     });
// }

// tapeCreate = () => {
//     $('#inputForm').submit(function (e) {
//         e.preventDefault();
//         var rName = app.rName;
//         var yName = app.yName;
//         var pass = app.pass;
//         var tape = app.tape;
//         $.ajax({
//             type: "POST",
//             url: 'insertData.php',
//             data: {
//                 option: 'POST',
//                 rName: rName,
//                 yName: yName,
//                 tape: tape,
//                 pass: pass
//             },
//             success: function (response) {
//                 var jsonData = JSON.parse(response);
//                 if (jsonData.success == "1") {
//                     button.val("Finished");
//                     $('#input').fadeOut(500, function () {
//                         $('#letter').fadeIn(500);
//                     });
//                     var link = jsonData.link
//                     app.link = link
//                     app.pass = pass
//                 } else {
//                     alert('Something went wrong');
//                 }
//             }
//         });
//     });
// };
