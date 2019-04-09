[![Build Status](https://travis-ci.org/musonza/groups.svg?branch=master)](https://travis-ci.org/musonza/groups)
[![Downloads](https://img.shields.io/packagist/dt/musonza/groups.svg?style=flat-square)](https://packagist.org/packages/musonza/groups)
[![StyleCI](https://styleci.io/repos/55277679/shield?branch=master)](https://styleci.io/repos/55277679)

# Description

This package allows you to add user groups _(groups, comment, like ...)_ system to your Laravel 5 application.

# Installation

1. Via **Composer**, from the command line, run :
```console
composer require musonza/groups
```

2. Add the service provider to `./config/app.php` in `providers` array, like :
```php
    /*
     * Package Service Providers...
     */
    Musonza\Groups\GroupsServiceProvider::class,
```

3. You can use the facade for shorter code. 
Add this to `./config/app.php` at the end of `aliases` array :

```php
    'Groups' => Musonza\Groups\Facades\GroupsFacade::class,
```

> Note : The class is bound to the ioC as Groups.
```php
$groups = App::make('Groups');
```

4. From the command line, publish the assets:
```console
php artisan vendor:publish
```

```console
php artisan migrate
```

# Usage

## Groups 

1. ##### Create a group

```php
$group = Groups::create($userId, $data);
```

> Note : Accepted fields in $data array : 
```php
$data = [
  'name'              => '',
  'description'       => '', // optional
  'short_description' => '', // optional
  'image'             => '', // optional
  'private'           => 0,  // 0 (public) or 1 (private)
  'extra_info'        => '', // optional
  'settings'          => '', // optional
  'conversation_id'   => 0,  // optional if you want to add messaging to your groups this can be useful
];
```

2. ##### Delete a group
```php
$group->delete();
```

3. ##### Update a group
```php
$group->update($updateArray);
```

4. ##### Get user instance with group relations
```php
$user = Groups::getUser($userId); 
```

5. ##### Add members to group
```php
$group->addMembers([$userId, $userId2, ...]);
```

6. ##### Request to join a group
```php
$group->request($userId);
```

7. ##### Accept a group request
```php
$group->acceptRequest($userId);
```

8. ##### Decline a group request
```php
$group->declineRequest($userId);
```

9. ##### Group requests
```php
$requests = $group->requests;
```

10. ##### How many groups a user is member of
```php
$user = Groups::getUser($userId); 
$count = $user->groups->count();
```

11. ##### Remove member(s) from group
```php
$group->leave([$userId, $userId2, ...]);
```

## Posts

1. ##### Create a post
```php
$post = Groups::createPost($data);
```
> Note : Acceptable values for Post $data array
```php
$data = [
  'title'      => '', 
  'user_id'    => 0, 
  'body'       => '', 
  'type'       => '', 
  'extra_info' => '',
];
```

2. ##### Get post
```php
$post = Groups::post($postId);
```

3. ##### Update a post
```php
$post->update($data);
```

4. ##### Delete a post
```php
$post->delete();
```

5. ##### Add a post to a group
```php
$group->attachPost($postId);
```

6. ##### Add multiple posts to a group
```php
$group->attachPost([$postId, $postId2, ...]);
```
7. ##### Remove post from a group
```php
$group->detachPost($postId);
```

8. ##### Group posts
```php
$posts = $group->posts;

$posts = $group->posts()->paginate(5);

$posts = $group->posts()->orderBy('id', 'DESC')->paginate(5);

```

9. ##### User posts
```php
$user = Groups::getUser($userId);

$posts = $user->posts;
```


## Comments

> Note : Acceptable values for Comment $data array
```php
$data = [
  'post_id' => 0,  
  'user_id' => 0, 
  'body'    => '',
];
```

1. ##### Add comment
```php
$comment = Groups::addComment($data);
```

2. ##### Get comment
```
$comment = Groups::comment($commentId);
```

3. ##### Update a comment
```php
$comment->update($data);
```

4. ##### Delete a comment
```php
$comment->delete();
```


## Reporting

1. ##### Report a comment or post
```php
$comment->report($userIdOfReporter);
$post->report($userIdOfReporter);
```

2. ##### Remove a post or comment report
```php
$post->removeReport($userId);
$comment->removeReport($userId);
```

3. ##### Toggle report/unreport a post or comment
```php
$post->toggleReport($userId);
$comment->toggleReport($userId);
```

4. ##### Post or Comment Report count
```php
$commentReports = $comment->reportsCount;
$postReports = $post->reportsCount;
```


## Likes

1. ##### Like a post or comment
```php
$post->like($userId);
$comment->like($userId);
```

2. ##### Unlike a post or comment
```php
$post->unlike($userId);
$comment->unlike($userId);
```
3. ##### Toggle like/unlike a post or comment
```php
$post->toggleLike($userId);
$comment->toggleLike($userId);
```

4. ##### Post or Comment likes count
```php
$postLikes = $post->likesCount;
$commentLikes = $comment->likesCount;
```
