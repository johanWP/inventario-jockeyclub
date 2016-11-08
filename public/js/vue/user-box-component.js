Vue.component ( 'user_box', {
    template: '#user_box-template',
    data: function () {
        return {
            editing: false,
            name: '',
            email: '',
            position: '',
            ext: ''
        }
    },
    props: [ 'user_id', 'csrf' ],
    methods: {
        edit: function () {
            this.editing = ! this.editing;
        },

        save: function () {
            // alert('name: ' + this.name + ', email: ' + this.email + ', position: ' + this.position + ', ext: ' + this.ext);
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
                    // alert('ok');
                } )
                .fail ( function () {
                    alert ( "error" );
                } )
                .always( function (  ) {
                    vm.editing = false;
                } );
        }
    },

    created: function () {
        this.user_id = JSON.parse ( this.user_id );
        vm = this;
        $.ajax ( "/api/getUserDetails/" + this.user_id )
            .done ( function ( data ) {
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