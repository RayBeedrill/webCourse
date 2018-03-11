<template>
  <v-container  grid-list-md text-xs-center >
    <h4>{{ msg }}</h4>
    <h6>{{ err }}</h6>
    <v-layout  row wrap>
      <v-flex xs6 offset-xs3>
      <v-text-field
        label="Book Title"
        v-model="title"
      ></v-text-field>
      <v-text-field
              name="input-7-1"
              label="Short description"
              multi-line
              v-model="shortDesc"
            ></v-text-field>
      <v-text-field
              name="input-7-1"
              label="Full description"
              multi-line
              v-model="desc"
            ></v-text-field>
            <v-text-field
        label="Price"
        v-model="price"
      ></v-text-field>
            <v-select
              label="Select"
              v-bind:items="itemsDiscount"
              item-value="id_discount"
              item-text="amount"
              v-model="eDisc"
              max-height="400"
              hint="Pick discount"
              persistent-hint
            ></v-select>
    </v-flex>
    <v-flex xs4>
      <v-select
              label="Select"
              v-bind:items="itemsAuth"
              item-text="name"
              item-value="id_author"
              v-model="e6"
              multiple
              max-height="400"
              hint="Pick authors"
              persistent-hint
            ></v-select>
    </v-flex>
    <v-flex xs4 offset-xs4>
      <v-select
              label="Select"
              v-bind:items="itemsGenres"
              item-text="name"
              item-value="id_genre"
              v-model="e7"
              multiple
              max-height="400"
              hint="Pick genres"
              persistent-hint
            ></v-select>
      
    </v-flex>
    <v-flex xs4 offset-xs4>
      <v-btn v-on:click="collectData" color="primary blue">edit</v-btn>
      
    </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
export default {
  name: 'EditBook',
  data () {
    return {
      msg: 'edit book',
      err: '',
      title:'',
      list:'list of books',
      shortDesc:'',
      desc:'',
      discount:'',
      price:'',
      authors:'',
      genres:'',
      e6: [],
      e7: [],
      eDisc:[],
      itemsAuth:[],
      itemsGenres:[],
      itemsDiscount:[],
    }
  },
  methods:{
      deleteBook(){
        let self = this
        let discount
        //this.$http.delete('http://192.168.0.15/~user4/shop/serv/application/api/books/').then(response => {
        this.$http.delete(myPath + 'application/api/books/' + this.$route.params.id).then(response => {

        
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
              self.itemsGenres.push(genres[obj])
          }
          let genresArr = this.genres.split(', ')
          for(let item in genres){
            for(let genre in genresArr){
              if(genres[item].name == genresArr[genre]){
                this.e7.push(genres[item].id_genre)
              }
            }
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
              self.itemsAuth.push(authors[obj]) 
          }
          
          let authorsArr = this.authors.split(', ')
          for(let item in authors){
            for(let auth in authorsArr){
              if(authorsArr[auth] == authors[item].name){
                this.e6.push(authors[item].id_author)
              }
            }
          }
        }, response => {
        
        });

      },
      getDiscount(){
        let self = this
        let discount
        //this.$http.get('http://192.168.0.15/~user4/shop/serv/application/api/discount/').then(response => {
        this.$http.get(myPath + 'application/api/discount/').then(response => {

        // get body data
          discount = response.body
          
          for(let obj in discount){
              self.itemsDiscount.push(discount[obj])
          }
          
        }, response => {
        
        });

      }, 
      getBookById(){
        // GET /someUrl
        let self = this
        let id = this.$route.params.id
        var bookArr

        let discount  
          //let link = 'http://192.168.0.15/~user4/shop/serv/application/api/books/' + id
          let link = myPath + 'application/api/books/' + id
          this.$http.get(link).then(response => {

          // get body data
          bookArr = response.body
          this.title = bookArr[0].title
          this.shortDesc = bookArr[0].shortDesc
          this.desc = bookArr[0].description
          this.price = bookArr[0].price
          this.authors = bookArr[0].authors
          this.genres = bookArr[0].genres
            
          
          
          
          }, response => {
          console.log(response)
          });
         //this.$http.get('http://192.168.0.15/~user4/shop/serv/application/api/discount/').then(response => {
        this.$http.get(myPath + 'application/api/discount/').then(response => {

        // get body data
          discount = response.body
          
          for(let obj in discount){
              if(bookArr[0].amount == discount[obj].amount){

                self.eDisc = discount[obj].id_discount
              }
          }


          
        }, response => {
        
        });

      },
      dataToParamString : function(data){
      var string= '';
      for(let val in data){
        string += val + '=' + encodeURIComponent(data[val]) + '&' 
      }
      
      return string;
      },
      collectData(){
          if(
             this.e6.length > 0 &&
             this.e7.length > 0 && 
             this.eDisc.length > 0 &&
             this.title.length > 0 &&
             this.desc.length > 0 &&
             this.shortDesc.length > 0 &&
             this.price.length > 0 
             ){
          
          let data = {
            'id': this.$route.params.id,
            'title' : this.title,
            'price': this.price,
            'shortDesc': this.shortDesc,
            'desc':this.desc,
            'discount': this.eDisc,
            'authors': this.e6,
            'genres': this.e7,
          }
          
          let str = this.dataToParamString(data)
          

          // this.$http.post('http://192.168.0.15/~user4/shop/serv/application/api/books/',data ,{headers:{'Content-Type':'application/x-www-form-urlencoded'}}).then(response => {
          //this.$http.put(myPath + 'application/api/books/',dataStr).then(response => {
          this.$http.put(myPath + 'application/api/books/',str).then(response => {
          this.err = 'succsess'
      
          console.log(response.body)

          }, response => {
                  this.err = response.statusText
          });  

        }else{
          if(this.e6.length === 0){
            this.err += 'choose authors, '
          }

          if(this.e7.length === 0){
            this.err += 'choose genres, '
          }

          if(this.eDisc.length === 0){
            this.err += 'choose discount, '
          }  

          if(this.title.length === 0){
            this.err += 'set title, '
          }  

          if(this.desc.length === 0){
            this.err += 'write desciption, '
          } 

          if(this.shortDesc.length === 0){
            this.err += 'write short desciption, '
          }

          if(this.price.length === 0){
            this.err += 'write price'
          }  
        }
        
      }
      
  },
  created:function(){
    this.getBookById()
    this.getGenres()
    this.getAuthors()
    this.getDiscount()

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
