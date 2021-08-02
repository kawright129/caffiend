<template>
    <div id="drinks" class="container pt-1">
        <nav class="navbar sticky-top rounded shadow-lg">
            <a class="navbar-brand" href="#">Caffiend</a>
            <span class="navbar-item text-center">
                <span :class="{'font-weight-bold':true, 'text-danger':showCaffeineLimitWarning}" v-text="user.caffeine_consumed"></span>/<span v-text="safe_caffeine_limit"></span>mg of Caffeine Consumed Today <br/>
                <span v-if="showCaffeineLimitWarning" class="text-danger"><strong>Warning!</strong> You have exceeded the recommended amount of daily caffeine consumption!</span>
            </span>
            <div class="navbar-item">
                <form @submit.prevent="search" class="pb-1">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Drink name" v-model="search_value" maxlength="250" autofocus>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary" :disabled="loading">
                                <span>Search</span>
                                <span v-if="loading" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            </button>
                        </div>
                        <div v-if="errorsExist">
                            <ul v-for="(error, index) in errors" :key="index">
                                <li v-text="error[0]"></li>
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
        </nav>

        <div class="my-md-3">

            <transition name="right-slide">
                <div v-if="drinksExist" class="row">
                    <drink-card v-for="(drink, index) in drinks" :key="index" :resultOrder="index" 
                        :drink="drink" 
                        :caffeine_consumed="user.caffeine_consumed" 
                        :safe_caffeine_limit="safe_caffeine_limit"
                        :drinks_consumed="user.drinks_consumed"
                        v-show="shouldShowDrink(drink.name)"
                        v-on:removeDrink="regurgitateDrink" 
                        v-on:addDrink="consumeDrink">
                    </drink-card>
                </div>
            </transition>

            <transition name="right-slide">
                <div v-show="show_no_results_card" class="row justify-content-md-center">
                    <div class="p-3 col-xs-12 col-sm-10 col-md-6">
                        <div class="card shadow-lg">
                            <div class="card-body">
                                <h5 class="card-title">Oh no! It looks like we couldn't find any drinks for that search.</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </transition>

        </div>

    </div>
</template>
<script>
    import axios from 'axios'
    import DrinkCard from '../components/DrinkCard.vue'
    export default {
        data() {
            return {
                search_value: "",
                searched_drinks: [],
                drinks: {},
                safe_caffeine_limit: 500,
                user: {
                    caffeine_consumed: 0,
                    drinks_consumed: {}
                },
                loading: false,
                show_no_results_card: false,
                errors: {}
            }
        },

        created() {
            this.getDrinks()
        },

        mounted() {
            if (localStorage.user) { 
                let data = JSON.parse(localStorage.user)
                if(data.hasOwnProperty('date') && data.date == this.getDate()) {
                    if(data.hasOwnProperty('data')) {
                        this.user = data.data
                    }
                }
            }
        },

        watch: {
            user: {
                handler(updated_user_data) {
                    localStorage.user = JSON.stringify( {'date': this.getDate(), 'data': updated_user_data} )
                },
                deep: true
            }
        },

        methods: {
            getDrinks: async function (e) {
                this.errors = {}

                return await axios.get(`/api/v1/drinks/`)
                .then(response => {
                    this.drinks = response.data
                    if(response.data.length == 0) {
                        this.show_no_results_card = true
                    } else {
                        this.show_no_results_card = false
                        this.drinks.forEach((drink) => {
                            this.searched_drinks.push(drink.name)
                        })
                    }
                })
                .catch(error => {
                    if (error.response.status == 422 && error.response.data.errors) {
                        this.errors = error.response.data.errors
                    } else  {
                        this.errors = {
                            'error' : ['Service is temporarily unavailable.']
                        }
                    }
                })
            },

            search: async function (e) {
                this.loading = true
                this.errors = {}

                return await axios.post(`/api/v1/drinks/search/`, { 
                    'search_value': this.search_value,
                })
                .then(response => {
                    this.loading = false
                    this.searched_drinks = []
                    if(response.data.length == 0) {
                        this.show_no_results_card = true
                    } else {
                        this.show_no_results_card = false
                        response.data.forEach((drink) => {
                            this.searched_drinks.push(drink.name)
                        })
                    }
                })
                .catch(error => {
                    this.loading = false
                    if (error.response.status == 422 && error.response.data.errors) {
                        this.errors = error.response.data.errors
                    } else  {
                        this.errors = {'error':[
                            'Service is temporarily unavailable.'
                        ]}
                    }
                })
            },

            consumeDrink: function (drink) {
                this.user.caffeine_consumed += drink.caffeine_content
            },

            regurgitateDrink: function (drink) {
                this.user.caffeine_consumed -= drink.caffeine_content
            },

            shouldShowDrink: function (drink_name) {
                return this.searched_drinks.indexOf(drink_name) !== -1 ? true : false
            },

            getDate: function(e) {
                let full_date = new Date()
                return full_date.getDate() + '/' + (full_date.getMonth() + 1) + '/' + full_date.getFullYear()
            }
        },

        computed: {
            errorsExist: function () {
                return Object.keys(this.errors).length > 0
            },
            drinksExist: function () {
                return Object.keys(this.drinks).length > 0
            },
            showCaffeineLimitWarning: function() {
                return this.user.caffeine_consumed > this.safe_caffeine_limit
            },
        },

        components: {
            DrinkCard
        }
    }
</script>