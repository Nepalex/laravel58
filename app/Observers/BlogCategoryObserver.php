<?php

namespace App\Observers;

use App\Models\BlogCategory;
use App\Models\BlogPost;

class BlogCategoryObserver
{

    /**
     * @param \App\Models\BlogCategory $blogCategory
     *
     * data processing before post update
     */
    public function creating(BlogCategory $blogCategory){

        $this->setSlug($blogCategory);

    }
    /**
     * Handle the blog category "created" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function created(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * @param \App\Models\BlogCategory $blogCategory
     *
     * data processing before post update
     */
    public function updating(BlogCategory $blogCategory){

        $this->setSlug($blogCategory);

    }

    /**
     * Handle the blog category "updated" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function updated(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Handle the blog category "deleted" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function deleted(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Handle the blog category "restored" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function restored(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Handle the blog category "force deleted" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function forceDeleted(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * @param \App\Models\BlogCategory  $blogCategory
     *
     * if the Slug field is empty, then fill from the title conversion
     */
    protected function setSlug(BlogCategory $blogCategory){

        if(empty($blogCategory->slug)){
            $blogCategory->slug = \Str::slug($blogCategory->title);
        }

    }
}
