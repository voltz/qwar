<b>Qwar
Specification Documentation</b>



Team Name 		: 	The Thinker<br/>
Team Members 	:	Indra,
				    Jeffrey,
				    Martono,
				    Thomas




1	Background Story

1.1	Background Story

1.1.1	Overview of Game
The name of the game is QWar, QWar is a game that provides the questions about general knowledge. The genre of this game is a multiplayer action game.

1.1.2	Background Story
Originated from the desire to provide the knowledge and increase the willingness of people in the world to increase knowledge about intelligence. In order that the people can increase his desire to learn about knowledge then this game was made by entering a combination of General knowledge and animation named QWar With this QWar game play, they can play while learning. Because the current average world people likes to play games.
2	Game Play Look and Feel
2.1	Appearance

 <p align="center">
  <img src="http://www.imageupload.co.uk/images/2014/12/08/Capture2.png"/>
</p>
Figure 1. Qwar – Room List  Screen

 <p align="center">
  <img src="http://www.imageupload.co.uk/images/2014/12/08/Capture.png"/>
</p>
Figure 2. Qwar – Room Game Screen


 <p align="center">
  <img src="http://www.imageupload.co.uk/images/2014/12/08/Capture3.png"/>
</p>
Figure 3. Qwar – Room Game Screen

 <p align="center">
  <img src="http://www.imageupload.co.uk/images/2014/12/08/Capture1.png"/>
</p>
Figure 4. Qwar – Game Result Screen


The sample screen above illustrates the look of QWar.  You will act as an answerer. This game is a great game to answer questions quickly and precisely in order to get the highest score and add experience to improve your level.

2.2	Players Roles and Actions

-	User/Players
1.	Publicly open to register. Use Twitter and Facebook API
2.	Login (using Facebook API  proxified using API Tools)
3.	Profile page (profile picture, history quiz, level, experience, HP, Attack Point)
4.	Choose Available Quiz and create room based on it. Or Join Available Room
5.	As host, can start the game / room
6.	Players can share their profile on Facebook

-	Game
1.	Each player have HP and Attack Point
2.	When game start, each player have to answer the question displayed on the screen just by typing the answer and press enter to submit. They can try as many as they can until one of the player get the correct answer or the time to answer that is over. The question is the same among other players to maintain a fair game
3.	When the time to answer is over and no one get the correct answer, each player will decrease his/her HP.
4.	When there is 1 person who get the correct answer, all players will be counted as lose (at that question) and there will be a popup window.
a.	For player with correct answer: all players will be subjected to attacks and
b.	For other players: they will be lose his/her HP..
5.	Player with 0 hp (dead) will remain in the room but could not answer any more questions.
6.	The game/quiz will end if
a.	There is only 1 person who is alive
b.	Quiz time reached
7.	When the game ends, it will display a list of players with highest Score first to lowest HP. When there are dead players, it will be sorted so the last dead player will be displayed first, and the first dead player will be displayed at the bottom.
8.	The questions can be displayed many times, but not in a row.

-	Quiz
1.	Have difficulty level. Can be filtered in user search.
2.	Each Quiz has maximum game time (i.e 10 minute)
3.	Each Quiz has consist of several questions
4.	Question can be text or image
5.	Each question have an experience point to be given to the player who answer it correctly
6.	Each question have time limit to answer this
7.	Answer is an essay, players just have to type the answer correctly

2.3	Development Specifications

-	Technology
1.	HTML5 : used in game process (when displaying the questions, set the answer box, attack animation)
2.	PHP : used as back-end process, exclude in game process
3.	NodeJS : used as back-end in game process
4.	MySQL : store the player stats and history
5.	HTML, CSS, bootstrap, Javascript, etc will be used as front-end/UI development, exclude game process

-	API  Usage
1.	APITools : Facebook API and Twitter API



3.     Summary

Teach players about everything mentioned in tailored Quiz. Schools or companies can use this application to measure the knowledge of their students or employees.They even can use this application to measure the knowledge of public people about their products, services, etc.

For further development, we want to build admin module to be given to schools and companies so they can add their quizes and set quiz to public or invitation only. Each admin can create other admin account with certain access permissions.

For further development of the schools, can be used to carry out tests of the ability of their students and the school's admission test. The school can also carry out tests to provide scholarships with a value chosen from the implementation of the quiz.

For further development of the companies, can be used to carry out tests of the ability of their employees and also admission test companies such as psychological test and test capabilities in specific areas. The company could also use this quiz to improve the performance of every employee and can also be used for questionnaires such as the assessment of a product on a general public

We also will create category/folder for quizes so players can find the related quiz easily in further development, as well as the title. Items to increase the stats or change the attack animation and more skills can also be developed later.

Chat feature can be useful too, especially when waiting the decision who will be attacked.

