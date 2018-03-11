<template>
<v-container  grid-list-md text-xs-center >
    <h4>{{ msg }}</h4>
    <h4>{{ err }}</h4>
    <v-layout  row wrap>
      <v-flex xs6 offset-xs3>
      <v-text-field
        style="display: inline-flex;width: 50%;"
        label="Genre Name"
        v-model="genre"
      ></v-text-field>
       <v-btn v-on:click="updateGenre" color="primary blue">Edit</v-btn>
       
    </v-flex>
<v-flex offset-xs4 xs4>
      <v-select
              label="Select"
              v-bind:items="itemsGenre"
              item-text="name"
              item-value="id_Genre"
              v-model="genre"
              max-height="400"
              hint="Pick Genres"
              persistent-hint
            ></v-select>
    </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
export default {
  name: 'EditGenre',
  created: function(){
    this.genresArr = []
    this.getGenres()
    
  },
  data () {
    return {
      msg: 'editGenre',
      genre:'',
      id:'',
      list:'Multy select list of Genres',
      itemsGenre:[],
      err:''
    }
  },
  methods:{
      getGenres(){
        let self = this
        //this.$http.get('http://192.168.0.15/~user4/shop/serv/application/api/genres/').then(response => {
        this.$http.get(myPath + 'application/api/genres/').then(response => {

        // get body data
          let genres = response.body
          
          for(let obj in genres){
              self.itemsGenre.push(genres[obj].name) 
              self.genresArr.push(genres[obj])
          }
          
        }, response => {
        
        });


      },
      updateGenre(){
        let self = this
        if(this.id.length > 0 && this.genre.length > 0){
          let data = {
            'id': this.id,
            'genre':this.genre
          }
          let str = this.dataToParamString(data)
          console.log(str)
          //this.$http.delete('http://192.168.0.15/~user4/shop/serv/application/api/genres/' + this.id).then(response => {
          this.$http.put(myPath + 'application/api/genres/',str).then(response => {
          this.err = 'succsess'
          window.location.reload()
          }, response => {
          
          });
        }else{
          this.err = 'choose Genre'
        }
      },
      deleteGenre(){
        let self = this

        //this.$http.delete('http://192.168.0.15/~user4/shop/serv/application/api/genres/' + this.id).then(response => {
        this.$http.delete(myPath + 'application/api/genres/' + this.id).then(response => {
        this.err = 'succsess'  
        
        }, response => {
          this.err = 'chooseGenre'
        });

      },
      dataToParamString : function(data){
      var string= '';
      for(let val in data){
        string += val + '=' + encodeURIComponent(data[val]) + '&' 
      }
       return string;
    }
  },
  watch:{
    genre(){
        let arr = this.genresArr
        for(let obj in  this.genresArr ){
          if(this.genresArr[obj].name == this.genre){
              this.id = this.genresArr[obj].id_genre
          }
        }
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
