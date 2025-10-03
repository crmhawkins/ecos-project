<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = BlogPost::with('author')->orderBy('created_at', 'desc');

        // Filtros
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('status')) {
            if ($request->status === 'published') {
                $query->published();
            } elseif ($request->status === 'draft') {
                $query->where('published', false);
            }
        }

        $posts = $query->paginate(15);
        $categories = BlogPost::getCategories();

        return view('crm.blog.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = BlogPost::getCategories();
        $suggestedTags = BlogPost::getSuggestedTags();
        
        return view('crm.blog.create', compact('categories', 'suggestedTags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required|string',
            'tags' => 'nullable|string',
            'published' => 'boolean',
            'published_at' => 'nullable|date',
            'meta_title' => 'nullable|string|max:60',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string',
            'og_title' => 'nullable|string|max:60',
            'og_description' => 'nullable|string|max:160',
            'og_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Procesar tags
        if ($request->filled('tags')) {
            $validated['tags'] = array_map('trim', explode(',', $request->tags));
        }

        // Procesar meta keywords
        if ($request->filled('meta_keywords')) {
            $validated['meta_keywords'] = array_map('trim', explode(',', $request->meta_keywords));
        }

        // Manejar imagen destacada
        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('blog/featured', 'public');
        }

        // Manejar imagen OG
        if ($request->hasFile('og_image')) {
            $validated['og_image'] = $request->file('og_image')->store('blog/og', 'public');
        }

        // Establecer autor
        $validated['author_id'] = Auth::id();

        // Si se marca como publicado, establecer fecha de publicación
        if ($validated['published'] && !$validated['published_at']) {
            $validated['published_at'] = now();
        }

        // Calcular tiempo de lectura
        $wordCount = str_word_count(strip_tags($validated['content']));
        $validated['reading_time'] = max(1, ceil($wordCount / 250));

        BlogPost::create($validated);

        return redirect()->route('crm.blog.index')
                        ->with('success', 'Artículo creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(BlogPost $blogPost)
    {
        $blogPost->load('author');
        return view('crm.blog.show', compact('blogPost'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BlogPost $blogPost)
    {
        $categories = BlogPost::getCategories();
        $suggestedTags = BlogPost::getSuggestedTags();
        
        return view('crm.blog.edit', compact('blogPost', 'categories', 'suggestedTags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BlogPost $blogPost)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required|string',
            'tags' => 'nullable|string',
            'published' => 'boolean',
            'published_at' => 'nullable|date',
            'meta_title' => 'nullable|string|max:60',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string',
            'og_title' => 'nullable|string|max:60',
            'og_description' => 'nullable|string|max:160',
            'og_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Procesar tags
        if ($request->filled('tags')) {
            $validated['tags'] = array_map('trim', explode(',', $request->tags));
        } else {
            $validated['tags'] = [];
        }

        // Procesar meta keywords
        if ($request->filled('meta_keywords')) {
            $validated['meta_keywords'] = array_map('trim', explode(',', $request->meta_keywords));
        } else {
            $validated['meta_keywords'] = [];
        }

        // Manejar imagen destacada
        if ($request->hasFile('featured_image')) {
            // Eliminar imagen anterior
            if ($blogPost->featured_image) {
                Storage::disk('public')->delete($blogPost->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('blog/featured', 'public');
        }

        // Manejar imagen OG
        if ($request->hasFile('og_image')) {
            // Eliminar imagen anterior
            if ($blogPost->og_image) {
                Storage::disk('public')->delete($blogPost->og_image);
            }
            $validated['og_image'] = $request->file('og_image')->store('blog/og', 'public');
        }

        // Si se marca como publicado por primera vez, establecer fecha de publicación
        if ($validated['published'] && !$blogPost->published && !$validated['published_at']) {
            $validated['published_at'] = now();
        }

        // Recalcular tiempo de lectura
        $wordCount = str_word_count(strip_tags($validated['content']));
        $validated['reading_time'] = max(1, ceil($wordCount / 250));

        $blogPost->update($validated);

        return redirect()->route('crm.blog.index')
                        ->with('success', 'Artículo actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogPost $blogPost)
    {
        // Eliminar imágenes asociadas
        if ($blogPost->featured_image) {
            Storage::disk('public')->delete($blogPost->featured_image);
        }
        if ($blogPost->og_image) {
            Storage::disk('public')->delete($blogPost->og_image);
        }

        $blogPost->delete();

        return redirect()->route('crm.blog.index')
                        ->with('success', 'Artículo eliminado exitosamente.');
    }

    /**
     * Toggle published status
     */
    public function togglePublished(BlogPost $blogPost)
    {
        $blogPost->update([
            'published' => !$blogPost->published,
            'published_at' => !$blogPost->published ? now() : $blogPost->published_at
        ]);

        $status = $blogPost->published ? 'publicado' : 'despublicado';
        
        return redirect()->back()
                        ->with('success', "Artículo {$status} exitosamente.");
    }
}