<template>
  <v-container  grid-list-md text-xs-center >
    <h4>{{ msg }}</h4>
    <h5>{{ err }}</h5>

    <v-layout  row wrap>
      <v-flex xs6 offset-xs3>
      <v-text-field
        style="display: inline-flex;width: 50%;"
        label="Author Name"
        v-model="author"
      ></v-text-field>
       <v-btn v-on:click="updateAuthor" color="primary blue">Edit</v-btn>
       
    </v-flex>
      <v-flex offset-xs4 xs4>
      <v-select
              label="Select"
              v-bind:items="itemsAuth"
              item-text="name"
              item-value="id_author"
              v-model="author"
              max-height="400"
              hint="Pick authors"
              persistent-hint
            ></v-select>
    </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
export default {
  name: 'EditAuthor',
  created: function(){
    this.authorsArr = []
    this.getAuthors()
    
  },
  data () {
    return {
      msg: 'editAuthor',
      author:'',
      id:'',
      list:'Multy select list of authors',
      itemsAuth:[],
      err:''
    }
  },
  methods:{
      getAuthors(){
        let self = this
        //this.$http.get('http://192.168.0.15/~user4/shop/serv/application/api/authors/').then(response => {
        this.$http.get(myPath + 'application/api/authors/').then(response => {

        // get body data
          let authors = response.body
          
          for(let obj in authors){
              self.itemsAuth.push(authors[obj].name) 
              self.authorsArr.push(authors[obj])
          }
          
        }, response => {
        
        });


      },
      updateAuthor(){
        let self = this
        if(this.id.length > 0 && this.author.length > 0){
          let data = {
            'id': this.id,
            'name':this.author
          }
          let str = this.dataToParamString(data)
          
          //this.$http.delete('http://192.168.0.15/~user4/shop/serv/application/api/authors/' + this.id).then(response => {
          this.$http.put(myPath + 'application/api/authors/',str).then(response => {
          this.err = 'succsess'
          window.location.reload()
          }, response => {
          
          });
        }else{
          this.err = 'choose author'
        }
      },
      deleteAuthor(){
        let self = this

        //this.$http.delete('http://192.168.0.15/~user4/shop/serv/application/api/authors/' + this.id).then(response => {
        this.$http.delete(myPath + 'application/api/authors/' + this.id).then(response => {

        
        }, response => {
        
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
    author(){
        let arr = this.authorsArr
        for(let obj in  this.authorsArr ){
          if(this.authorsArr[obj].name == this.author){
              this.id = this.authorsArr[obj].id_author
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
