# Reputation Scoring

This paper seeks to answer two questions related to email service providers:

1. How do you prove that email senders are actually who they say they are? (Authentication)

2. Once you've got a high degree of certainty that the senders are who they say they are, how do you rate the likelihood of the senders' message being spam? (Reputation)


Traditional spam fighting systems rely on tracking lists of IP addresses.  Each IP address is associated with an email server.  You can use lists to track good IP addressed (ie Those that are unlikely to produce spam) and other lists that track bad IP addresses (i.e. Those likely to produce spam).  The challenge with these lists is that

* they have to be manually updated
* it assumes email servers maintain the same IP address (not the case!)


### Answering Q1

To answer the first question above, the paper proposes that email service providers use two techniques to authenticate users - SPF and DKIM.  They both rely on domain names.

SPF allows the senders to specify which IP addresses are associated with a given domain name.  The recipient can then check that list and authenticate the sender.

DKIM relies on public key encryption.  Key peices of the email are used to create a hash.  That hash is then encrypted using the sender's private key.  The signature is added to the email header.  The recipient used DNS to find the sender's public key and then validates the signature.

*** Senders can and should use both techniques.

### Answering Q2

Once the sender has been authenticated, the receiving mail server has to determine whether the message is spam or not.

The paper proposes the following formula (see appendix for definitions):

```
good = autononspam + manualnonspam − manualspam
total = autospam + autononspam
reputation = (100 ∗ good)/total
```

The reputation score ends up being between 0 and 100, where 100 is least likely to send spam.  The score is then compared to a threshold.  If it's greater than the threshold, the message will be placed in the inbox.  If not, the message will be placed in the spam folder.

#### Benefits
1. The entire process (authentication and reputation) is automated for the mail service provider - so no more maintaining lists.
2. Each user can impact the reputation scores by manually tagging messages as spam or not spam
3. Email systems can be set up so that each user can have his / her own threshold


#### Some Gotchas
1. When mail is forwarded, the forwarder is the entity that feels the reputation impact, not the original sender
2. Reputation is determined at the domain level, not the individual sender level.
3. Not all users manually mark spam/unspam.


### Appendix

* autospam: How many times mail from this sender went into the spam folder automatically.
* autononspam: How many times mail from this sender went into the inbox automatically.
* manualspam: How many times a user marked a message from this sender as spam.
* manualnonspam: How many times a user marked a message from this sender as nonspam.
