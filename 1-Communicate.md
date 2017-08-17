# Reputation Scoring

This paper seeks to answer two questions related to email services

1. How do you prove that the email sender is actually who they say they are? (Authentication)

2. Once you've got a high degree of certainty that the senders are who they say they are, how do you rate the senders' likelihood of sending spam? (Reputation)


Traditional spam fighting systems rely on tracking lists of IP addresses.  Each IP address is associated with an email server.  There can be lists that track good IP addressed (ie Those that are unlikely to produce spam) and there are lists that track bad IP addresses (i.e. Those likely to produce spam).  The challenge with these lists is that

i. they have to be manually updated
ii. it assumes email servers maintain the same IP address (not the case!)


## Answering Q1

To answer the first question above, the paper proposes that email service providers use two techniques to authenticate users - SPF and DKIM.  They both rely on domain names.

SPF allows the senders to specify which IP addressed are associated with a given domain name.  The recipient can then check that list and authenticate the sender.

DKIM relies on public key encryption.  Key peices of the email are used to create a hash.  That hash is then encrypted using the sender's private key.  The signature is added to the email header.  The recipient used DNS to find the sender's public key and then validates the signature.

*** Senders can and should use both techniques.

## Answering Q2

Once the sender has been authenticated, the receiving mail server has to determine whether the message is spam or not.

The paper proposes a formula

```
good = autononspam + manualnonspam − manualspam
total = autospam + autononspam
reputation = (100 ∗ good)/total
```

The higher the score, the better the reputation.

```
autospam: How many times mail from this sender went into the spam folder automatically.
autononspam: How many times mail from this sender went into the inbox automatically.
manualspam: How many times a user marked a message from this sender as spam.
manualnonspam: How many times a user marked a message from this sender as nonspam.
```

## Setting up the environment

docker volume create mysqlv

docker run -d -p 80:80 -p 3306:3306 -v ~/projects/proton:/var/www/html -v mysqlv:/var/lib/mysql -e MYSQL_PASS="ronnie" --name lamp tutum/lamp
