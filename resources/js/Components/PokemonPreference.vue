<template>
  <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        My Favorite pokemon
                    </div>
                    <div class="p-8" v-if="favoritePokemonList.length">
                      <PokemonListIndividual :isFavoritePokemon=true :pokemonList="favoritePokemonList" :imageUrl="imageUrl" :apiUrl="apiUrl" @setPokemonUrl="setPokemonUrl"/>
                      <PokemonDetail
                        v-if="showDetail"
                        :pokemonUrl="pokemonUrl"
                        :imageUrl="imageUrl"
                        @closeDetail="closeDetail"
                      />
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        My Liked pokemon(s)
                    </div>
                    <div class="p-8" v-if="likePokemonList.length">
                      <PokemonListIndividual :isLikePokemon=true :pokemonList="likePokemonList" :imageUrl="imageUrl" :apiUrl="apiUrl" @setPokemonUrl="setPokemonUrl"/>
                      <PokemonDetail
                        v-if="showDetail"
                        :pokemonUrl="pokemonUrl"
                        :imageUrl="imageUrl"
                        @closeDetail="closeDetail"
                      />
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        My Hated pokemon(s)
                    </div>
                    <div class="p-8" v-if="hatePokemonList.length">
                      <PokemonListIndividual :isHatePokemon=true :pokemonList="hatePokemonList" :imageUrl="imageUrl" :apiUrl="apiUrl" @setPokemonUrl="setPokemonUrl"/>
                      <PokemonDetail
                        v-if="showDetail"
                        :pokemonUrl="pokemonUrl"
                        :imageUrl="imageUrl"
                        @closeDetail="closeDetail"
                      />
                    </div>
                </div>
            </div>
  </div>
</template>
<script>
import PokemonListIndividual from "./PokemonListIndividual.vue";
import PokemonDetail from "./PokemonDetail.vue";

export default {
  data: () => {
    return {
      imageUrl:
        "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/",
      apiUrl: "https://pokeapi.co/api/v2/pokemon/",
      pokemonUrl: "",
      showDetail: false,
      favoritePokemonList: [],
      likePokemonList: [],
      hatePokemonList: [],
      isFavoritePokemon: false,
      isLikePokemon: false,
      isHatePokemon: false,
    };
  },
  components: {
    PokemonListIndividual,
    PokemonDetail
  },
  methods: {
    setPokemonUrl(url) {
      this.pokemonUrl = url;
      this.showDetail = true;
    },
    closeDetail() {
      this.pokemonUrl = "";
      this.showDetail = false;
    },
    getFavoritePokemon(){
      axios.get('/getFavoritePokemon',)
          .then((response) => {
            response.data.forEach(pokemon => {
              this.favoritePokemonList.push(pokemon);
            });
          }, (error) => {
            console.log(error);
          });
    },
    getLikePokemon(){
      axios.get('/getLikePokemon',)
          .then((response) => {
            response.data.forEach(pokemon => {
              this.likePokemonList.push(pokemon);
            });
          }, (error) => {
            console.log(error);
          });
    },
    getHatePokemon(){
      axios.get('/getHatePokemon',)
          .then((response) => {
            response.data.forEach(pokemon => {
              this.hatePokemonList.push(pokemon);
            });
          }, (error) => {
            console.log(error);
          });
    }
  },
  created() {
      this.getFavoritePokemon();
      this.getLikePokemon();
      this.getHatePokemon();
    }
}
</script>
<style lang="scss" scoped>
.container {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  padding: 10px;
  width: calc(100% - 20px);
  min-height: calc(100vh - 20px);
  //background: radial-gradient(#ffbf0b, #e20000);

  font-family: "Acme", arial;
  font-size: 1rem;
  font-weight: normal;
}

h1 {
  color: #efefef;
}
</style>