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
                app.step++;
            })
        }
    },
})

var app2 = new Vue({
    el: '#app2',
    data: {
        fail: '',
        success: '',
        pass: '',
        yName: '',
        rName: '',
        tape: '',
        link: '-85ZLn7alaSHU',

    },
    beforeCreate: function(){
        axios.post('insertData.php', {
            link: this.link,
            option: 'RETRIEVE',
        }).then(function (response) {
            if (response.data === 'fail' || !response.data) {
                app2.fail = 1
            }else{
                app2.fail = 0
            }
        })      
    },
    methods: {
        verifyTape(){
            axios.post('insertData.php', {
                link: this.link,
                pass: this.pass,
                option: 'VERIFY',
                yName: '',
                rName: '',
                tape: ''
            }).then(function (response) {
                if (response.data == 'fail') {
                    alert('incorrect pass')
                }else{
                    app2.yName = response.data.yName
                    app2.rName = response.data.rName
                    app2.tape = response.data.tape
                    app2.success = 1
                    app2.fail = ''
                }
            })
        }
    },
})