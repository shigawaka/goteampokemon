<template>
  <div class="list md:container columns-3">
    <div class="w-full" v-for="(pokemon, index) in pokemons"
    :key="'poke'+index"
    @click="setPokemonUrl(currentUrl + pokemon.id)">
      <img :src="imageUrl + pokemon.id + '.png'" width="96" height="96" alt="">
      <h3>{{ pokemon.name }}</h3>
      <button type="button" class="mb-2 mr-2 focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900" @click="removePokemon(pokemon.id, favPok, likePok, hatePok)">Remove</button>
    </div>
  </div>
</template>

<script>
  export default {
    props: [
      'imageUrl',
      'apiUrl',
      'pokemonList',
      'isFavoritePokemon',
      'isLikePokemon',
      'isHatePokemon',
    ],
    data: () => {
      return {
        pokemons: [],
        currentUrl: '',
        favPok: false,
        likePok: false,
        hatePok: false,
        newPokemonUrl: '',
      }
    },
    methods: {
      fetchData() {
        this.pokemonList.forEach((value, index) => {
              axios.get(this.currentUrl + value.pokemonId,)
                .then((response) => {
                  this.pokemons.push(response.data);
                }, (error) => {
                  console.log(error);
                });
          });
      },
      setPokemonUrl(url) {
        this.$emit('setPokemonUrl', url);
      },
      removePokemon(id,isFavPok,isLikePok,isHatePok){
        if(isFavPok){
          axios.delete('/removeFavoritePokemon', { data: { pokemonId: id } 
          })
            .then((response) => {
              alert('Successfully deleted');
              window.location.reload();
            }, (error) => {
              console.log(error);
            });
        }
        else if(isLikePok){
          axios.delete('/removeLikePokemon', { data: { pokemonId: id } 
          })
            .then((response) => {
              alert('Successfully deleted');
              window.location.reload();
            }, (error) => {
              console.log(error);
            });
        }
        else if(isHatePok){
          axios.delete('/removeHatePokemon', { data: { pokemonId: id } 
          })
            .then((response) => {
              alert('Successfully deleted');
              window.location.reload();
            }, (error) => {
              console.log(error);
            });
        }
      }
    },
    created() {
      this.currentUrl = this.apiUrl;
      this.favPok = this.isFavoritePokemon;
      this.likePok = this.isLikePokemon;
      this.hatePok = this.isHatePokemon;
      this.fetchData();
    }
  }
</script>

<style lang="scss" scoped>
  .list {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    grid-gap: 10px;
    width: 100%;
    max-width: 510px;    
  }
    article {
      height: 150px;
      background-color: #efefef;
      text-align: center;
      text-transform: capitalize;
      border-radius: 5px;
      cursor: pointer;
      box-shadow: 0 15px 30px rgba(0,0,0,.2),
                  0 10px 10px rgba(0,0,0,.2);      
    }
    h3 {
        margin: 0;
      }
</style>

