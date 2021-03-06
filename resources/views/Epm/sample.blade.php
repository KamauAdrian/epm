<script>
    methods: {
        getUsers: function () {
            this.$http.get('/api/get/users').then(function (response) {
                this.users = response.data;
                this.updateUsers();
                console.log(this.users)
            }, function (response) {
                console.log(response)
            });
        },
        updateUsers: function () {
            this.options = this.users;
        }
    },
    created: function () {
        this.getUsers();
    }
    };
</script>
