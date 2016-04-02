## Groups 

This package allows you to add user groups system to your Laravel 5 application

## Installation

From the command line, run:

```
composer require musonza/groups
```

Add the service provider to your `config\app.php` the providers array

```
Musonza\Groups\GroupsServiceProvider
```

You can use the facade for shorter code. Add this to your aliases:

```
'Groups' => Musonza\Groups\Facades\GroupsFacade::class` to your `config\app.php
```

The class is bound to the ioC as Groups

```
$groups = App::make('Groups');
```

Publish the assets:

```
php artisan vendor:publish
```

This will publish database migrations.

#### Groups 

###### Create a group

```
$group = Groups::create($userId, $data);
```
Accepted fields in $data array 

```
$data = [
        'name',
        'description', // optional
        'short_description', // optional
        'image',   // optional
        'private', // 0 or 1
        'extra_info', // optional
        'settings', // optional
        'conversation_id', // optional if you want to add messaging to your groups this can be useful
    ];
```

###### Delete a group
```
$group->delete();
```

###### Update a group
```
$group->update($updateArray);
```

###### Get user instance with group relations
```
$user = Groups::getUser($userId); 
```

###### Add members to group
```
$group->addMembers([$userId, $userId2, ...]);
```

###### Request to join a group
```
$group->request($userId);
```

###### Accept a group request
```
$group->acceptRequest($userId);
```

###### Decline a group request
```
$group->declineRequest($userId);
```

###### Group requests
```
$requests = $group->requests;
```

###### How many groups a user is member of
```
$user = Groups::getUser($userId); 
$count = $user->groups->count();
```

###### Remove member(s) from group
```
$group->leave([$userId, $userId2, ...]);
```

#### Posts

###### Create a post
```
$post = Groups::createPost($data);
```
Acceptable values for Post $data array
```
$data = ['title', 'user_id', 'body', 'type', 'extra_info'];
```

###### Get post
```
$post = Groups::post($postId);
```

###### Update a post
```
$post->update($data);
```
###### Delete a post
```
$post->delete();
```
###### Add a post to a group
```
$group->attachPost($postId);
```
###### Add multiple posts to a group
```
$group->attachPost([$postId, $postId2, ...]);
```
###### Remove post from a group
```
$group->detachPost($postId);
```

###### Group posts
```
$posts = $group->posts;

$posts = $group->posts()->paginate(5);

$posts = $group->posts()->orderBy('id', 'DESC')->paginate(5);

```

###### User posts
```
$user = Groups::getUser($userId);

$posts = $user->posts;
```
#### Comments

Acceptable values for Comment $data array
```
$data = ['post_id', 'user_id', 'body'];
```

###### Add comment
```
$comment = Groups::addComment($data);
```

###### Get comment
```
$comment = Groups::comment($commentId);
```

###### Update a comment
```
$comment->update($data);
```

###### Delete a comment
```
$comment->delete();
```

#### Reporting

###### Report a comment or post
```
$comment->report($userIdOfReporter);
$post->report($userIdOfReporter);
```

###### Remove a post or comment report
```
$post->removeReport($userId);
$comment->removeReport($userId);
```

###### Toggle report/unreport a post or comment
```
$post->toggleReport($userId);
$comment->toggleReport($userId);
```

###### Post or Comment Report count
```
$commentReports = $comment->reportsCount;
$postReports = $post->reportsCount;
```

#### Likes

###### Like a post or comment
```
$post->like($userId);
$comment->like($userId);
```
###### Unlike a post or comment
```
$post->unlike($userId);
$comment->unlike($userId);
```
###### Toggle like/unlike a post or comment
```
$post->toggleLike($userId);
$comment->toggleLike($userId);
```

###### Post or Comment likes count
```
$postLikes = $post->likesCount;
$commentLikes = $comment->likesCount;
```





