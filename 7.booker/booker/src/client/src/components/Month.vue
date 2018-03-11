<template>
  <div class="calend-table">
    <table class="table table-bordered">
      <thead>
        <tr>
          <td v-if="format == 'RU'" v-for="day in daysTextRu">{{day}}</td>
          <td v-if="format == 'US'" v-for="day in daysTextUs">{{day}}</td>
        </tr>
      </thead>
      <tbody>
        <tr v-for="week in days">
          <td v-for="day in week">
            <day  
            v-bind:timeFormat="hourF"
            v-bind:dayData="daysProps"
            v-bind:room="room"
            v-bind:day="day"
            v-bind:year="year"
            v-bind:month="monthNumber"
            v-bind:admin="admin"
            ></day>       
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import Day from './Day'
export default {
  name: 'month',
  created(){
    this.getEvents()
    this.checkAdmin()
  },
  data () {
    return {
      msg: 'month',
      daysTextUs:['sunday','monday','tuesday','wednesday','thursday','friday','saturday'],
      daysTextRu:['monday','tuesday','wednesday','thursday','friday','saturday','sunday'],
      events:[],
      days:this.monthArr,
      daysProps:[],
      month:this.monthNumber,
      admin:false
    }
  },
  props:['monthArr','format','monthNumber','room','year','hourF'],
  components:{
    Day
  },
  methods:{
    getEvents(){
      let mon = this.monthNumber + 1
      let str  = this.year + '/' + mon

      let succ = (result) => {
        
        this.daysProps = []
        for(let obj in result){
          result[obj].dayCreation += '000'
          result[obj].endEvent += '000'
          result[obj].startEvent += '000'
        }
        
        this.daysProps = []
        for(let week in this.days){
          for(let day in this.days[week]){
            this.getDayProp(this.days[week][day]['data'],result)
          }
        }
         
      }

     getQuery(this,myPath + 'application/api/events/',str).then(succ,null)
    },
    getDayProp(day, arr){

      for(let dayObj in arr){
        var eventStamp = arr[dayObj].startEvent
        var eventStamp = parseInt(eventStamp)
        
        var eventDay = new Date(eventStamp).getDate()
        var eventMonth = new Date(eventStamp).getMonth()
        var eventYear = new Date(eventStamp).getFullYear()
                
        if(day == eventDay && eventMonth == this.monthNumber){
            
          let dateStart = parseInt(arr[dayObj].startEvent)
          let dateEnd = parseInt(arr[dayObj].endEvent)
          var data = {
            id:arr[dayObj].id_event,
            day:eventDay,
            start: dateStart,
            end: dateEnd,
            desc: arr[dayObj].desc,
            roomId: arr[dayObj].roomId,
            year:eventYear,
            month: eventMonth,
            user:arr[dayObj].user
          }
          this.daysProps.push(data)
         
        }
      }
       
    },
    checkAdmin(){
      let adminCheck = (result) => {        
        if(result.id_role == "1"){
          this.admin = true
        }else{
          this.admin = false
        }
      }
     getQuery(this,myPath + 'application/api/auth/').then(adminCheck,null)
    },
  },
  watch:{
    monthArr(newArr){
      this.days = newArr
      this.getEvents()

    },
    monthNumber(val){
      
      this.getEvents()
    }
  },
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

.title{
  text-align: center;
  margin-top: 15px;
}
.login-div{
  height: 180px;
  width: 100%;
  margin-top: 75px;
  padding: 15px 15px 0 15px;
  border-radius: 4px;
  -webkit-box-shadow: 0px 2px 13px 5px #B0B0B0;
  box-shadow: 0px 2px 13px 5px #B0B0B0;
}
.login-div form{
  text-align: center;
}

.login-div input{
  margin-top: 15px;
} 

.login-div button{
  margin-top: 15px;
}

td{
      text-align: left;
    min-height: 75px;
    width: 75px
}
</style>
