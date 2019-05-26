var app = new Vue({
    el: '#app',
    data: {
        rName: '',
        tape: '',
        yName: '',
        link: '',
        pass: '',
        code1: '',
        code2: '',
        many: 1,
        step: 0,
        timer: 10,
        transitionName: 'left',
        isActive: false,
        isActiveMid: false,
        isActiveLast: false,
        initActive: true,
    },
    methods: {
        changeStep(direction) {
            if (direction === 'next') {
                this.transitionName = 'left'
                this.step++
            } else {
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
                many: this.many,
                code1: this.code1,
                code2: this.code2,
                timer: this.timer,
            }).then(function (response) {
                app.link = response.data.link;
                app.step++;
            })
        },
    },
    mounted: function () {
        setTimeout(doSomething = () => {
            this.isActive = true;
        }, 100);
        setTimeout(doSomething = () => {
            this.isActiveMid = true;
        }, 200);
        setTimeout(doSomething = () => {
            this.isActiveLast = true;
        }, 300);
    },
})

var app2 = new Vue({
    el: '#app2',
    data: {
        fail: '',
        success: '',
        pass: '',
        code1: '',
        code2: '',
        yName: '',
        rName: '',
        tape: '',
        vFail: 0,
        isActive: false,
        isActiveMid: false,
        isActiveLast: false,
        destruct: 0,
        link: '-1372GUoF7BQ5c',
        step: 1

    },
    created: function () {
        axios.post('insertData.php', {
            link: this.link,
            option: 'RETRIEVE',
        }).then(function (response) {
            if (response.data === 'fail' || !response.data) {
                app2.fail = 1
            } else if (response.data === 'noViews') {
                app2.fail = 2
            } else {
                app2.fail = 0
            }
        })
    },
    methods: {
        verifyTape() {
            axios.post('insertData.php', {
                code1: this.code1,
                code2: this.code2,
                link: this.link,
                pass: this.pass,
                option: 'VERIFY',
                yName: '',
                rName: '',
                tape: '',
            }).then(function (response) {
                if (response.data == 'fail') {
                    app2.vFail = 1;
                } else if (response.data == 'dFailed') {
                    app2.vFail = 2;
                } else {
                    app2.vFail = 0;
                    app2.yName = response.data.yName
                    app2.rName = response.data.rName
                    app2.tape = response.data.tape
                    app2.success = 1
                    app2.fail = ''
                    app2.destruct = response.data.timer
                    var timer = setInterval(doSomething = () => {
                        if (app2.destruct > 0) {
                            app2.destruct--;
                        } else {
                            app2.step++;
                            clearInterval(timer)
                        }
                    }, 1000);

                }
            })
        }
    },
    mounted: function () {
        setTimeout(doSomething = () => {
            this.isActive = true;
        }, 100);
        setTimeout(doSomething = () => {
            this.isActiveMid = true;
        }, 200);
        setTimeout(doSomething = () => {
            this.isActiveLast = true;
        }, 300);
    },
})