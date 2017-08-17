# Design a Reputation System

### Data tables (See SQL directory)

1. __User__: Stores the information for each user of your email service
2. __Message__: Stores each message
3. __Reputation__: Stores counts and scores related to reputation by domain name
4. __User_Spam_Action__: Tracks user events related to marking and unmarking spam for specific messages


### Process: New Mail

1. A message is received.
2. DNS lookups are performed for both DKIM and SPF (assuming the sender uses both)
3. If the domain names are authenticated, proceed with the updated mail headers
4. RegEx is used to extract relevant data from mail header: domain names, recipient, scores, etc.
5. the reputation scores for the domain names are pulled from the reputation table in the database
6. User information is pulled from the User table
7. The domain name's reputation score is compared to the user's threshold.  If the score is greater than the threshold, the message will be put in the input.  If not, the message will be placed in spam.
8. The message is inserted into the Message table
8. The reputation score is recalculated and updated in the Reputation table


### Process: Manual Spam
1. User clicks "Make Spam" or "Not Spam" button
2. That action is posted to the server
3. The server receives the action and the message ID
4. The message is pulled from the Message table
5. The reputation data is pulled for the message's domain name
6. The user action data is pulled from the User_Spam_Action table
7. The domain name's reputation score is recalculated
8. All three tables are updated accordingly

### Assumptions

1. SpamAssassin handles authentication
2. There will be two entries in the reputation table for each domain - one for DKIM and one for SPF
3. If both DKIM and SPF are used, take the highest score
4.
