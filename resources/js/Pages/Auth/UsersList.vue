<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
</script>

<template>
    <Head title="Users List" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <img
                  class="mx-auto"
                  alt="Vue logo"
                  src="https://upload.wikimedia.org/wikipedia/commons/9/98/International_Pok%C3%A9mon_logo.svg"
                >
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div id="app">
                          <div v-for="user in users[page_index]" class="max-w-xs rounded my-2 border border-gray-300 p-2 text-sm text-gray-700">
                            <div>
                              User: {{user.firstName}} {{user.lastName}}
                            </div>
                            <div v-if="user.favorite.length">
                              <p class="text-md text-gray-600">Favorite Pokemon: {{user.favorite[0].name}}</p>
                            </div>
                            <div v-if="user.like.length">
                              <p class="text-md text-gray-600">Like Pokemon(s): <p v-for="like in user.like" class="text-md text-gray-600">{{like.name}}</p></p>
                            </div>
                            <div v-if="user.hate.length">
                              <p class="text-md text-gray-600">Hate Pokemon(s): <p v-for="hate in user.hate" class="text-md text-gray-600">{{hate.name}}</p></p>
                            </div>
                          </div>
                       <ul class="flex pt-6" >
                            <li :class="{ 'active': index === 0 }" v-for="(page, index) in users">
                              <a class="p-2 text-sm" href="#" v-on:click.prevent="paginate(event)">
                                {{index+1}}
                              </a>
                            </li>
                          </ul>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
<script>
  export default {
      el: '#app',
      data: () => {
        return {
        users: [],
        user_count: 0,
        page_index: 0,
        page_size: 5,
        };
      },
      mounted: function() {
        this.fetchData();
      },
      methods: {
        fetchData: function(){
          axios.get('/usersListData',)
                .then((response) => {
                  this.user_count = response.data.length;
                  this.users = this.array_chunk(response.data, this.page_size);
                  this.insertPokemonName();
                }, (error) => {
                  console.log(error);
                });
        },
        array_chunk: function(array, size) {
          const chunked_arr = [];
          let index = 0;
          while (index < array.length) {
            chunked_arr.push(array.slice(index, size + index));
            index += size;
          }

          return chunked_arr;
        },
        paginate: function(event) {
          var $target = $(event.target);
            $('.active').removeClass('active');
            $target.closest('li').addClass('active');
            vm.page_index = parseInt($target.text().trim()) - 1;
            window.scrollTo({ top: 0, behavior: 'smooth' });
        },
        insertPokemonName(){
            // append name of pokemons in array
            this.users.forEach((value, index) => {
                value.forEach(favPoke => {
                        // append favorite pokemon name
                        favPoke.favorite.forEach(poke => {
                            axios.get('https://pokeapi.co/api/v2/pokemon/' + poke.pokemonId,)
                              .then((response) => {
                                poke.name = response.data.name
                              }, (error) => {
                                console.log(error);
                              });
                        });
                        // append like pokemon name
                        favPoke.like.forEach(poke => {
                            axios.get('https://pokeapi.co/api/v2/pokemon/' + poke.pokemonId,)
                              .then((response) => {
                                poke.name = response.data.name
                              }, (error) => {
                                console.log(error);
                              });
                        });
                        // append hate pokemon name
                        favPoke.hate.forEach(poke => {
                            axios.get('https://pokeapi.co/api/v2/pokemon/' + poke.pokemonId,)
                              .then((response) => {
                                poke.name = response.data.name
                              }, (error) => {
                                console.log(error);
                              });
                        });
                    });
              });
            
        }
      }
  }
</script>
<style>
.active {
  border-bottom: solid 3px #25A26B
}
</style>

