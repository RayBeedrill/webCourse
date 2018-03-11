<template>
	<v-container  grid-list-md text-xs-center >
		<v-layout  row wrap>
		  	<v-flex xs4>
			    <v-select
			      v-bind:items="items1"
			      v-model="select1"
			      label="Author"
			      data-vv-name="select"
			    ></v-select>
			</v-flex>
			<v-flex xs4>
			    <v-select
			      v-bind:items="items2"
			      v-model="select2"
			      label="Genre"
			      data-vv-name="select"
			    ></v-select>
			</v-flex>
			<v-flex class='text-xs-left' xs4>
				<v-btn small v-on:click="clearFilter" style="margin: 18px;"  color="primary">Clear</v-btn>
			</v-flex>
		</v-layout>
		<v-layout row wrap>
			<v-flex v-for="obj in filterBooks" xs12 :key="obj.id_book" sm4 text-xs-center>
		      <v-card  class="elevation-10">
		        </v-card-media>
		        <v-card-title primary-title>
		          <v-flex xs12>
		            <h3 class="headline mb-0">{{obj.title}}</h3>
		            <p>{{obj.shortDesc}}</p>
		            <p>{{obj.price + currency}}</p>
		          </v-flex>
		        </v-card-title>
		        <v-card-actions >
		          <router-link style="margin: 0 auto" :to="'/singleProduct/' + obj.id_book"><v-btn flat color="blue">Show description</v-btn></router-link>
		        </v-card-actions>
		      </v-card>
		    </v-flex>
		</v-layout>
	</v-container>
</template>

<script>
export default {
  name: 'AllBooks',
  created: function(){
  	this.getAllBooks();
    this.getAuthors();
    this.getGenres();
  },
  data () {
    return {
      msg: 'All books',
      select1: null,
        items1: [],
      select2: null,
        items2: [],
       allBooksArr:[],
       currency: currency
      }
    },
    methods:{
    	getAllBooks(){

  // GET /someUrl
    //this.$http.get('http://192.168.0.15/~user4/shop/serv/application/api/books/').then(response => {
  	this.$http.get(myPath + 'application/api/books/').then(response => {

    // get body data
    let data = response.body
    for(let obj in data){
      this.allBooksArr.push(data[obj])
    }
  	}, response => {
    
  });

    	},
    getAuthors(){
        let self = this
        //this.$http.get('http://192.168.0.15/~user4/shop/serv/application/api/authors/').then(response => {
        this.$http.get(myPath + 'application/api/authors/').then(response => {

        // get body data
          let authors = response.body
          for(let obj in authors){
            self.items1.push(authors[obj].name)
          }
          
        }, response => {
        
        });
      },
      getGenres(){
        let self = this
        //this.$http.get('http://192.168.0.15/~user4/shop/serv/application/api/genres/').then(response => {
        this.$http.get(myPath + 'application/api/genres/').then(response => {

        // get body data
          let genres = response.body
          for(let obj in genres){
            self.items2.push(genres[obj].name)
          }
        }, response => {
        
        });
      },
      clearFilter(){
        this.select1 = null
        this.select2 = null
      }
    },
    computed:{
      filterBooks(){
          let self = this

          let checkAuthor = function(el){
            if(self.select1 == null){
              return true
            }
            let authorsArr = el.authors.split(', ')
            for(let author in authorsArr){
              if(self.select1 == authorsArr[author]){
                return true
              }
            }
          }

          let checkGenre = function(el){
            if(self.select2 == null){
              return true
            }
            let genresArr = el.genres.split(', ')
            for(let genre in genresArr){
              if(self.select2 == genresArr[genre] || self.select2 == null){
                return true
              }
            }
          }

          return this.allBooksArr.filter(function(el){
              return checkGenre(el) && checkAuthor(el)
          })
      }
    }
  }
</script>

    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h1, h2 {
  font-weight: normal;
}

ul {
  list-style-type: none;
  padding: 0;
}

li {
  display: inline-block;
  margin: 0 10px;
}

a {
  color: #42b983;
}
</style>
