<template>
    <div>
        <h2>Echo Test</h2>
        <ul>
            <li v-for="message in messages">
                {{message}}
            </li>
        </ul>
    </div>
</template>

<script>
    import Echo from 'laravel-echo';
    import client from 'pusher-js';

    export default {
        data() {
            return {
                messages: [],
            }
        },
        mounted() {
            const echo = new Echo({
                broadcaster: 'pusher',
                // TODO: Put this in env variable
                key: '4699e564583f4910202e',

                // client, // this can be added if there's already an existing pusher client
                cluster: 'us3'
            });

            echo.channel('test.channel')
                .listen('.test.event', (e) => {
                    console.log(e);
                });
        }
    }
</script>
