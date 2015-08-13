/**
 * 
 */
"use strict";

var piece;
function place(object, x, y) {
   object.style.left=x+"px";
   object.style.top=y+"px";
}

function getX(object) {
   return parseInt(object.style.left);
}

function getY(object) {
   return parseInt(object.style.top);
}

function swapIt(object1,object2) {
	   var x1=getX(object1);
	   var y1=getY(object1);
	   var x2=getX(object2);
	   var y2=getY(object2);
	   place(object2,x1,y1);
	   place(object1,x2,y2);
	   
	}


function pageLoad() {

      var area=document.getElementById ('puzzlearea');
      piece=area.getElementsByTagName('div');
      var a = 0;
      var leftVar=0;
      var topVar = 0;
      var xValue=0;
      var yValue=0;
      document.getElementById ('shufflebutton').onclick=shuffle; 

      for (var i=0; i<piece.length; i++)
      {
    	 
    		  piece[i].className='puzzlepiece';
    		 piece[i].style.color = "red";
    		  piece[i].style.top = ""+topVar+"px";
    		  piece[i].style.left = ""+leftVar+"px";
    		  piece[i].onmouseover= mouseOverFunc;
    		  piece[i].onmouseout= mouseOutFunc;
    		  piece[i].style.backgroundPosition = xValue+'px ' + yValue + 'px'; 
    		  piece[i].onclick=slide; 
    		  
    		  xValue = xValue - 100;
    		  leftVar=leftVar+100;
    		  
    		  if((i+1)%4==0)
    			  {
    			  	topVar = topVar + 100;
    			  	leftVar=0;
    			  	xValue=0;
    			  	yValue=yValue-100;
    			  }

    		  
    	  }

      var element = document.createElement('div');
      element.id = "emptySquare";
      area.appendChild(element);
      document.getElementById('emptySquare').className='emptypiece';
      document.getElementById('emptySquare').style.position='absolute';
      document.getElementById('emptySquare').innerHTML="16";
      document.getElementById('emptySquare').style.left=leftVar+"px";
      document.getElementById('emptySquare').style.top=topVar+"px";   
}

function mouseOverFunc()
{
	  var emp = document.getElementById('emptySquare');
	   var empX=getX(emp);
	    var empY=getY(emp);
		if((empY==getY(this)+100 && (empX==getX(this))) || empX+100==getX(this) && empY==getY(this) ||  empY==getY(this) && (empX==getX(this)+100) || empX==getX(this) && empY+100==getY(this) )
			{
			this.className='puzzlepiece'+ ' movablepiece';
			}
}

function shuffle()
{
	for( var j =0 ; j < 1000 ; j++)
		{
		var sideDiv=[];
		for (var i=0; i<piece.length; i++)
		{ 
			    	 	var emp = document.getElementById('emptySquare');
					    var empX=getX(emp);
					    var empY=getY(emp);
					    var selectedX=getX(piece[i]);
					    var selectedY=getY(piece[i]);
						if((empY==selectedY+100 && (empX==selectedX))  )
							{
								sideDiv.push(i);
							}
						else if ( empX+100==selectedX && empY==selectedY )
							{
							sideDiv.push(i);
							}
						else if ( empY==selectedY && (empX==selectedX+100) )
						{
							sideDiv.push(i);
						}
						else if (  empX==selectedX && empY+100==selectedY )
						{
							sideDiv.push(i);
						}
		}
		var randonNumber = parseInt(Math.random()*(sideDiv.length));
		var toSwap = sideDiv[randonNumber];
		swapIt(piece[toSwap], document.getElementById('emptySquare'));


		}
	
}


function mouseOutFunc()
{
	this.className='puzzlepiece';		
}



function slide() {
 
    var emp = document.getElementById('emptySquare');
    var empX = 0;

     empX = getX(emp);
    var empY=getY(emp);
	if((empY==getY(this)+100 && (empX==getX(this))) || empX+100==getX(this) && empY==getY(this) ||  empY==getY(this) && (empX==getX(this)+100) || empX==getX(this) && empY+100==getY(this) )
		{
		 swapIt(emp,this);
		}
		
		
/*		
	//--------------------------------
	      var area=document.getElementById ('puzzlearea');
	      var a = 1;
	      var prevX=0;
	      var prevY=0;
	      var currX=0;
	      var currY=0;
		  for (var i=5; i<=area.childNodes.length; i++)
	      {
	    	  if (piece[i].nodeName=="DIV")
	    		  { 
	    		  a = a + 1;
	    		//  alert(piece[i].innerHTML);
	    		  currX=getX(piece[i]);
	    		  currY=getY(piece[i]);
	    		 // alert("Curr X "+currX+" Curr Y "+currY+" PrevX "+prevX+" Prev Y "+prevY);
	    		  if(a%4==1)
	    			  {
	    			  	if(((prevX-currX)!=300) || ((currY-prevY)!=100) )
	    			  		{ break; }
	    			  } else
	    				  {
	    				  	if(currX-prevX!=100 || currY!=prevY)
	    				  		 { break; }
	    				  }
	    		  prevY=currY;
	    		  prevX=currX;
	    		//  alert("Position "+a +" is good");
	    		  }
	   
	      }
	 	  if( a == 16)
                  {
    		  alert("CONGRATULATIONS!!!!! :Game has been WON !");
                  }
                  
                  */
 }



window.onload = pageLoad;
