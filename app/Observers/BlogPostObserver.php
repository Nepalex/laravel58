<?php

namespace App\Observers;

use App\Models\BlogPost;
use Illuminate\Support\Carbon;

class BlogPostObserver
{
    /**
     * @param \App\Models\BlogPost $blogPost
     *
     * data processing before post update
     */
  public function creating(BlogPost $blogPost){

        $this->setPublishedAt($blogPost);
        $this->setSlug($blogPost);
        $this->setHtml($blogPost);
        $this->setUser($blogPost);

    }

    /**
     * Handle the blog post "created" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function created(BlogPost $blogPost)
    {
        //
    }


    /**
     * @param BlogPost $blogPost
     *
     * data processing before post update
     */
    public function updating(BlogPost $blogPost){

        $this->setPublishedAt($blogPost);
        $this->setSlug($blogPost);


    }
    /**
     * Handle the blog post "updated" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function updated(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the blog post "deleted" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function deleted(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the blog post "restored" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function restored(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the blog post "force deleted" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function forceDeleted(BlogPost $blogPost)
    {
        //
    }


    /**
     * if the publication date is not set and Checkbox Publish is set,
     * then the current publication date is set
     */
    protected function setPublishedAt(BlogPost $blogPost){

        $needSetPublishedAt = empty($blogPost->published_at) && $blogPost->is_published;

        if ($needSetPublishedAt){
            $blogPost->published_at = Carbon::now();
        }
    }

    /**
     * @param BlogPost $blogPost
     *
     * if the Slug field is empty, then fill from the title conversion
     */
    protected function setSlug(BlogPost $blogPost){

        if(empty($blogPost->slug)){
            $blogPost->slug = \Str::slug($blogPost->title);
        }

    }

    /**
     * @param BlogPost $blogPost
     * Set content_html value from content_raw
     */
    protected function setHtml(BlogPost $blogPost){

        if($blogPost->isDirty('content_raw')){
           /**
            * TODO hier must be markdown generetion -> html
            */
            $blogPost->content_html = $blogPost->content_raw;
        }
    }
    /**
     * @param BlogPost $blogPost
     * if User is not set , then default value set
     */
    protected function setUser(BlogPost $blogPost){

        $blogPost->user_id = auth()->id() ?? BlogPost::UNKNOWN_USER;

    }


}
