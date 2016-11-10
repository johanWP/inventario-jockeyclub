Vue.component ( 'user_box', {
    template: '#user_box-template',
    data: function () {
        return {
            editing: false,
            name: '',
            email: '',
            position: '',
            ext: '',
            error: ''
        }
    },
    props: [ 'user_id', 'csrf' ],
    methods: {
        edit: function () {
            this.editing = ! this.editing;
        },

        save: function () {
            vm = this;
            $.ajax ({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                url: "/api/postUserDetails",
                data: { user_id: vm.user_id, name: vm.name, email: vm.email, position: vm.position, ext: vm.ext }
            })
                .done ( function ( data ) {
                    vm.editing = false;
                } )
                .fail ( function (data) {
                    var errors = data.responseJSON;
                    $.each(errors, function (index, value) {
                        vm.error = value[0];
                    });
                });
        }
    },
    created: function () {
        this.user_id = JSON.parse ( this.user_id );
        vm = this;
        $.ajax ( "/api/getUserDetails/" + this.user_id )
            .done ( function ( data, msg ) {
                vm.name = data.name;
                vm.email = data.email;
                vm.position = data.position;
                vm.ext = data.ext;
            } )
            .fail ( function () {
                alert ( "error" );
            } );
    }
} );

new Vue ( {
    el: '#wrapper',
    components: [
        'user_box'
    ]
} );