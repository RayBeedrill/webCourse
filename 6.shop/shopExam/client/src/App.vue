<template>
  <div id="app">
   <!-- 
    <router-view/>-->
    <v-app id="inspire" light>
    <v-navigation-drawer
    temporary
      clipped
      persistent
      v-model="drawer"
      enable-resize-watcher
      app
    >
      <v-list dense>
        <v-list-tile v-if="!returnLogin" @click="">
          <v-list-tile-action>
            <v-icon>account_box</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title><router-link to="/signin">Sign in</router-link></v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
        <v-list-tile v-if="!returnLogin" @click="">
          <v-list-tile-action>
            <v-icon>person_add</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title><router-link to="/signup">Sign up</router-link></v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
        <v-list-tile @click="">
          <v-list-tile-action>
            <v-icon>books</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title><router-link to="/">All books</router-link></v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
          <v-list-group v-for="item in items" :value="item.active" v-bind:key="item.title">
            <v-list-tile slot="item" @click="">
              <v-list-tile-action>
                <v-icon>{{ item.action }}</v-icon>
              </v-list-tile-action>
              <v-list-tile-content>
                <v-list-tile-title>{{ item.title }}</v-list-tile-title>
              </v-list-tile-content>
              <v-list-tile-action>
                <v-icon>keyboard_arrow_down</v-icon>
              </v-list-tile-action>
            </v-list-tile>
            <v-list-tile v-for="subItem in item.items" v-bind:key="subItem.title" @click="">
              <v-list-tile-content>
                <v-list-tile-title v-if="item.id == '1'"><router-link :to="subItem.link">{{ subItem.title }}</router-link></v-list-tile-title>
                <v-list-tile-title v-if="item.id == '2'"><router-link :to="subItem.link">{{ subItem.title }}</router-link></v-list-tile-title>
              </v-list-tile-content>
              <v-list-tile-action>
                <v-icon>{{ subItem.action }}</v-icon>
              </v-list-tile-action>
            </v-list-tile>
          </v-list-group>
          <v-list-group v-if="item.id == 1 && returnAdmin || item.id == 2 && returnLogin" v-for="item in acountPages" :value="item.active" v-bind:key="item.title">
            <v-list-tile slot="item" @click="">
              <v-list-tile-action>
                <v-icon>{{ item.action }}</v-icon>
              </v-list-tile-action>
              <v-list-tile-content>
                <v-list-tile-title>{{ item.title }}</v-list-tile-title>
              </v-list-tile-content>
              <v-list-tile-action>
                <v-icon>keyboard_arrow_down</v-icon>
              </v-list-tile-action>
            </v-list-tile>
            <v-list-tile v-for="subItem in item.items" v-bind:key="subItem.title" @click="">
              <v-list-tile-content>
                <v-list-tile-title v-if="item.id == '1'"><router-link :to="subItem.link">{{ subItem.title }}</router-link></v-list-tile-title>
                <v-list-tile-title v-if="item.id == '2'"><router-link :to="subItem.link">{{ subItem.title }}</router-link></v-list-tile-title>
              </v-list-tile-content>
              <v-list-tile-action>
                <v-icon>{{ subItem.action }}</v-icon>
              </v-list-tile-action>
            </v-list-tile>
          </v-list-group>
        </v-list>
    </v-navigation-drawer>
    <v-toolbar app fixed clipped-left>
      <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
      <v-toolbar-title><router-link to="/">GeekBooks</router-link></v-toolbar-title>
      <v-spacer></v-spacer>
      <v-toolbar-items v-if="returnLogin" class="hidden-sm-and-down">
        <router-link to="/profile/info"><v-btn flat><v-icon>person</v-icon></v-btn></router-link>
        <router-link to="/profile/cart"><v-btn flat><v-icon>shopping_cart</v-icon></v-btn></router-link>
       <a><v-btn v-on:click="logout" flat><v-icon>exit_to_app</v-icon></v-btn></a>
      </v-toolbar-items>
    </v-toolbar>
    <main>
      <v-content>
        
          
             <router-view/>
          
       
      </v-content>
    </main>
    <v-footer app fixed>
      <span>&copy; 2017</span>
    </v-footer>
  </v-app>
  </div>
</template>

<script>
export default {
  data: () => ({
      drawer: false,
       name: 'app',
       authors:[],
       genres:[],
        items: [
          
        ],
        acountPages: [
          {
            id:1,
            action: 'settings',
            title: 'Admin panel',
            items: [
              { 
                title: 'User Orders',
                link:'/Admin/orders'
              },
              { 
                title: 'Add Book',
                link:'/Admin/addBook'
              },
              { 
                title: 'Add Author',
                link:'/Admin/addAuthor'
              },
              { 
                title: 'Add Genre',
                link:'/Admin/addGenre'
              },
              { 
                title: 'Add User',
                link:'/Admin/addUser'
              },
              { 
                title: 'Add Discount',
                link:'/Admin/addDiscount'
              },
              { 
                title: 'Edit Book',
                link:'/Admin/listBooks'
              },
              { 
                title: 'Edit Author',
                link:'/Admin/editAuthor'
              },
              { 
                title: 'Edit Genre',
                link:'/Admin/editGenre'
              },
              { 
                title: 'Edit User',
                link:'/Admin/editUser'
              },
              { 
                title: 'Edit Discount',
                link:'/Admin/editDiscount'
              }
            ]
          },
          {
            id:2,
            action: 'info',
            title: 'Profile',
            items: [
              { 
                title: 'User Info',
                link:'/profile/info'
              },
              { 
                title: 'User Cart',
                link:'/profile/cart'
              },
              { 
                title: 'User Orders',
                link:'/profile/orders'
              }
            ]
          },
        ],
      login: false,
      admin: false,
    }),
    props: {
      source: String
    },
    created: function() {
      this.getAuthors()
      this.getGenres()
      this.login = this.$route.meta.login
      this.getLogin()
      
    },
    methods:{
      getAuthors(){
        let self = this
        //this.$http.get('http://192.168.0.15/~user4/shop/serv/application/api/authors/').then(response => {
        this.$http.get(myPath + 'application/api/authors/').then(response => {

        // get body data
          let authors = response.body
          let data = {
            id:1,
            action: 'face',
            title: 'All authors',
            items: []
          }
          for(let obj in authors){
            let link = { title: authors[obj].name, link: '/byauthor/' + authors[obj].id_author }
            data.items.push(link)
          }
          self.items.push(data)
          
        }, response => {
        
        });
      },
      getGenres(){
        let self = this
        //this.$http.get('http://192.168.0.15/~user4/shop/serv/application/api/genres/').then(response => {
        this.$http.get(myPath + 'application/api/genres/').then(response => {

        // get body data
          let genres = response.body
          let data = {
            id:2,
            action: 'playlist_add_check',
            title: 'All genres',
            items: []
          }
          for(let obj in genres){
            let link = { title: genres[obj].name, link: '/bygenre/' + genres[obj].id_genre }
            data.items.push(link)
          }
          self.items.push(data)
          
        }, response => {
        
        });
      },
      getLogin(){
        this.$http.get(myPath + 'application/api/auth/').then(response => {
          
         let data = response.body  
         
         if(data.id_role == '1' && this.login){
         
          this.admin = true
         }
         
         
      
        }, response => {
    
        });
      },
      logout(){
         this.$http.delete(myPath + 'application/api/auth/').then(response => {
      
         this.login = false
         this.admin = false
         window.location.reload()
         window.location.href = shopHome + '#/signin'
          
        }, response => {
    
        });
      }
    },
     watch: {
      '$route' (to, from) {
          this.login = from.meta.login
      }
    },
    computed:{
      returnLogin(){
        return this.login
      },
      returnAdmin(){
        return this.admin
      },
    }
  }
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}

a{
 text-decoration: none;
}

</style>
