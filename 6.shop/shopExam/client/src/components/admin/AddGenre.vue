<template>
<v-container  grid-list-md text-xs-center >
    <h4>{{ msg }}</h4>
    <h6>{{ err}}</h6>
    <v-layout  row wrap>
      <v-flex xs6 offset-xs3>
      <v-text-field
        style="display: inline-flex;width: 50%;"
        label="Genre Name"
        v-model="genres"
      ></v-text-field>
       <v-btn v-on:click="createGenre" color="primary blue">Add</v-btn>
    </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
export default {
  name: 'AddGenre',
  data () {
    return {
      msg: 'AddGenre',
      genres:'',
      list:'list of Genre',
      err:''
    }
  },
  methods:{
    createGenre(){
      let headersVal = {'Content-Type':'application/x-www-form-urlencoded'}
      let data = new FormData()
      data.append('genre', this.genres)
      if(this.genres.length > 0){
        this.err = ''
        // this.$http.post('http://192.168.0.15/~user4/shop/serv/application/api/genres/',data ,{headers:{'Content-Type':'application/x-www-form-urlencoded'}}).then(response => {
        this.$http.post(myPath + 'application/api/genres/',data ,{headers:{'Content-Type':'application/x-www-form-urlencoded'}}).then(response => {
          this.err = 'succsess'
          this.genres = ''
          window.location.reload()
  }, response => {
          this.err = response.statusText
  });  
        
      }else {
        this.err = "field empty"
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
