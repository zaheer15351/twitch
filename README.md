# twitch app

A barebones PHP app that makes use of the [Silex](http://silex.sensiolabs.org/) web framework, which can easily be deployed to Heroku.


## Deploying

Install the [Heroku Toolbelt](https://toolbelt.heroku.com/).

```sh
$ git clone git@github.com:zaheer15351/twitch.git
$ cd php-getting-started
$ heroku create
$ git push heroku master
$ heroku open
```

This app is already deployed on [Heroku](https://secure-springs-34454.herokuapp.com/).

## Task requirement

In this task, it was suppose to complete the following in 4 hours max

- The first/home page lets a user login with Twitch and set their favorite Twitch streamer name. This initiates a backend event listener which listens to all events for given streamer.
- The second/streamer page shows an embedded livestream, chat and list of 10 most recent events for your favorite streamer. This page doesn’t poll the backend and rather leverages web sockets and relevant Twitch API.

## Scope covered

In the given timeframe, I managed to complete the following

- Home page that lets a user login with Twitch
- Streamer page that shows an embedded livestream and a chat box from a streamer

## Scope not covered

- I couldn't find any documentation for fetching Events from a streamer, although I created some events in my account and tried to show them on Streamer Page but twitch doesn't allowed it. 
- I couldn't manage to write a backend listener which listens to all events for a given streamer as in given timeframe I couldn't find any documentation for the API that fetches/listens for events created by streamer.

## Additional Questions to answer

- How would you deploy the above on AWS? (ideally a rough architecture diagram will help)
    - I will configure CodePipeline linked with GitHub's webhook to fetch source when there is any change.
    - Changes will be forwarded to CodeDeploy
    - CodeDeploy will be configured to deploy code over the designated Target group
    - Target group will be configured with one or more instances (based on auto-scaling configs)

<img src="https://i.imgur.com/uRVBwam.png" width="370" height="515" alt="Architecture Digram" />

- Where do you see bottlenecks in your proposed architecture and how would you approach scaling this app starting from 100 reqs/day to 900MM reqs/day over 6 months?
    - Initially, we can go with <b>Computer Optimized c5.large</b> Ec2 instance
    - We should have Auto scaling configured with minimum 1 and maximum 5 instances configurations
    - Autos scaling group should be configured with a scaling policy to scale up when <b>Average CPU Utilization </b> increases from 80%
    - If needed, we can modify our number of maximum instances in Auto scaling group.   
