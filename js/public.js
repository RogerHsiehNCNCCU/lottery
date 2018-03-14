var media=null;
var media2=null;
var flag=false;
var timer=null;
function play(url,loop_flag){
    this.url=url;
    this.loop_flag=loop_flag;
    this.playMusic=function(){
        //on pc browser
		if(media!=null){//初始化(若media不是null，將media設為null)，目的是要將目前撥放的音樂停止，以便播放下一個
			media.pause();//停止目前播放的音樂
			media=null;
		}
		media=document.createElement("audio");//create新的audio標籤，存放下一個要撥放的音樂
		media.src="../"+this.url;
		media.load();
        
        media.play();//playback
    };
    this.repeat=function(){
        flag=this.loop_flag;
        if(flag==true){
            jQuery(media).bind("ended",function(){
                media.currentTime=0;
                media.play();
            });
        }
    };
    this.pause=function(){
        if(navigator.userAgent.match(/(iPhone|iPad|Android|BlackBerry)/)){
            if(media!=null)
                media.stop();
        }
        else{
            if(media!=null)
                media.pause();
        }
    };
}
function playMusic(url,loop_flag){
    flag=loop_flag;
	//on pc browser
	if(media!=null){//初始化(若media不是null，將media設為null)，目的是要將目前撥放的音樂停止，以便播放下一個
		media.pause();//停止目前播放的音樂
		media=null;
	}   
	media=document.createElement("audio");//create新的audio標籤，存放下一個要撥放的音樂
	media.src="../"+url;
	media.load();
    //media.play();//playback 預設為暫時
    if(flag==true){
        jQuery(media).bind("ended",function(){
            media.currentTime=0;
            media.play();
        });
    }
}
function changeMusic(){
    //利用html audio Element的屬性回傳audio是否暫停中
    if(media.paused) media.play();
	else media.pause();
}
function clickMusic(Mpath){//點擊播放音效
    //on pc browser
	if(media2!=null){//初始化(若media不是null，將media設為null)，目的是要將目前撥放的音樂停止，以便播放下一個
		media2.pause();//停止目前播放的音樂
		media2=null;
	}   
	media2=document.createElement("audio");//create新的audio標籤，存放下一個要撥放的音樂
	media2.src="../"+Mpath;
	media2.load();

    media2.play();//playback
}