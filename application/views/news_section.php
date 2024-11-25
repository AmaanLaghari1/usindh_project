<section id="event" class="">
        <div class="container pb-50">
          
      
    <div class="section-content">
          <div class="row">
            <div class="col-md-6">
              <h3 class="text-uppercase line-bottom mt-0 line-height-1"><i class="fa fa-calendar mr-10"></i> <span class="text-theme-color-2">News</span></h3>
             
              <div id='news'>
              </div>      
            </div>
            <div class="col-md-6">
              <h3 class="text-uppercase line-bottom mt-0 line-height-1"><i class="fa fa-calendar mr-10"></i> <span class="text-theme-color-2">Events</span></h3>
                 <div id='new_event'>
                </div>    
            </div>
          
          </div>
        </div>
  </div>
    </section>

<script>

                      
                   var i = 0 ;
                      
                var list_of_no = [1,2,3,4,5,6,7,8,9];
                   list_of_no = shuffle(list_of_no);
function shuffle(array) {
  let currentIndex = array.length,  randomIndex;

  // While there remain elements to shuffle.
  while (currentIndex != 0) {

    // Pick a remaining element.
    randomIndex = Math.floor(Math.random() * currentIndex);
    currentIndex--;

    // And swap it with the current element.
    [array[currentIndex], array[randomIndex]] = [
      array[randomIndex], array[currentIndex]];
  }

  return array;
}
    function getNews(NEWS_TYPE,id){
      jQuery.ajax({
                url: "https://news.usindh.edu.pk/Apis/getNews?END=2&NEWS_TYPE="+NEWS_TYPE,
                async:false,
                success: function (data, status) {
                   console.log(data.DATA);
                   list = data.DATA;
                    let k = 1;
                   list.forEach(item => {
                        //var randomNumber = Math.floor(Math.random() *4 ) + 1;
                        var randomNumber = list_of_no[i++];
                        const des = getFirstNWords(item.DESCRIPTION,10);
                        var  name= "news"+randomNumber;
                        if(NEWS_TYPE!=1){
                            name= "events"+k;
                            k++;
                        }
                        //const title = getFirstNWords(item.TITLE,20);
                        const title = item.TITLE;
                        const link = "https://news.usindh.edu.pk/Web/news_detail?id="+item.NOTIFICATION_ID;
                        const artical = ` <article class="post media-post clearfix pb-0 mb-10">
                            <a href="${link}" class="post-thumb mr-20"><img alt="" width="100px" height="100px" src="images/event/${name}.png"></a>
                            <div class="post-right">
                              <h4 class="mt-0 mb-5"><a href="#">${title}</a></h4>
                              <ul class="list-inline font-12 mb-5">
                                <li class="pr-0"><i class="fa fa-calendar mr-5"></i> ${item.PUBLICATION_DATE} |</li>
                                <li class="pl-5"><i class="fa fa-map-marker mr-5"></i>${item.NAME} </li>
                              </ul>
                              <p class="mb-0 font-13">${des}</p>
                              <a class="text-theme-colored font-13" href="${link}">Read More →</a>
                            </div>
                          </article>
                        `;
                        $('#'+id).append(artical);
                      });
                },
                beforeSend:function (data, status) {

                },
                error:function (data, status) {

                },
            });
    }
    $(document).ready(()=>{
        getNews(1,'news');
        getNews(3,'new_event');
    });
  function getFirstNWords(sentence,n) {
  // Split the sentence into words
  let words = sentence.split(/[\s,]+/);
  
  // Extract the first 10 words
  let first10Words = words.slice(0, n);
  
  // Join the first 10 words back into a string
  let result = first10Words.join(' ');

  // Return the result
  return result;
}


    </script>