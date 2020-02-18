<template>
    <div class="movie-detail">
        <p v-if="loading">Loading...</p>

        <div v-else>
            <h2>{{ details.title }}</h2>
            <h4 class="mb-4">{{ details.description }}</h4>

            <h5>Comments and Reviews:</h5>
            <ul class="list-unstyled">
                <li v-for="review in details.reviews" class="media border mb-2 rounded p-2">
                    <div class="media-body">
                        <p class="m-0">{{ review.comment }}</p>
                    </div>
                </li>
            </ul>
            <button @click="addReview">Add Review</button>
        </div>
    </div>
</template>

<script>
    import axios from "axios";

    export default {
        data() {
            return {
                details: {},
                loading: null,
                error: null
            };
        },
        methods: {
            addReview() {
                axios
                    .post('https://movie-rental.financial/api/films/1/reviews?rating=3&comment=NewComment', )
                    .then(response => (this.details.reviews.push(response.data.data)))
            }
        },
        mounted () {
            this.loading = true;
            axios
                .get('https://movie-rental.financial/api/films/1')
                .then(response => (this.details = response.data[0]))
                .catch(e => this.error = e)
                .finally(() => this.loading = false)
        }
    };
</script>
