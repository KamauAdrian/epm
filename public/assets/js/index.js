new Vue({
    components: {
        Multiselect: window.VueMultiselect.default,
        axios: window.axios.defaults,
    },
    data() {
        return {
            selectedCmTeam: null,
            cmsTeams: [],
        }
    },
    mounted () {
        this.getCmTeams()
    },
    methods:{
        getCmTeams(){
            axios
                .get('/cms/teams')
                .then(response => {
                    this.cmsTeams = response.data
                })
                .catch(error => {
                    console.log(error)
                    this.errored = true
                })
                .finally(() => this.loading = true)
        }
    },
}).$mount('#teams_cms')

var clock = new Vue({
    el: '#clock',
    data: {
        clock: false,
        clock_in: 'Clock In',
        time: '',
        date: ''
    },
    methods:{
        clock_iin: function (){
                clock.clock_in = 'CLock Out'
        }
    }
});

var week = ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'];
var timerID = setInterval(updateTime, 1000);
updateTime();
function updateTime() {
    var cd = new Date();
    clock.time = zeroPadding(cd.getHours(), 2) + ':' + zeroPadding(cd.getMinutes(), 2) + ':' + zeroPadding(cd.getSeconds(), 2);
    clock.date = zeroPadding(cd.getFullYear(), 4) + '-' + zeroPadding(cd.getMonth()+1, 2) + '-' + zeroPadding(cd.getDate(), 2) + ' ' + week[cd.getDay()];
};

function zeroPadding(num, digit) {
    var zero = '';
    for(var i = 0; i < digit; i++) {
        zero += '0';
    }
    return (zero + num).slice(-digit);
}
