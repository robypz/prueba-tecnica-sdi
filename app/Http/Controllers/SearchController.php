<?php

namespace App\Http\Controllers;

use App\Http\Requests\search\SearchRequest;
use Illuminate\Support\Facades\Http;

class SearchController extends Controller
{
    /**
     * Search for items (tracks, artists, albums, playlists, shows, episodes, audiobooks).
     *
     * Returns paged results for each requested type.
     *
     * @response array{
     *   "tracks": array{
     *     "href": "string",
     *     "limit": "integer",
     *     "next": "string|null",
     *     "offset": "integer",
     *     "previous": "string|null",
     *     "total": "integer",
     *     "items": array<array{
     *       "album": array{
     *         "album_type": "string",
     *         "total_tracks": "integer",
     *         "available_markets": array<string>,
     *         "external_urls": array{"spotify": "string"},
     *         "href": "string",
     *         "id": "string",
     *         "images": array<array{
     *           "url": "string",
     *           "height": "integer",
     *           "width": "integer"
     *         }>,
     *         "name": "string",
     *         "release_date": "string",
     *         "release_date_precision": "string",
     *         "restrictions": array{"reason": "string"}|null,
     *         "type": "string",
     *         "uri": "string",
     *         "artists": array<array{
     *           "external_urls": array{"spotify": "string"},
     *           "href": "string",
     *           "id": "string",
     *           "name": "string",
     *           "type": "string",
     *           "uri": "string"
     *         }>
     *       },
     *       "artists": array<array{
     *         "external_urls": array{"spotify": "string"},
     *         "href": "string",
     *         "id": "string",
     *         "name": "string",
     *         "type": "string",
     *         "uri": "string"
     *       }>,
     *       "available_markets": array<string>,
     *       "disc_number": "integer",
     *       "duration_ms": "integer",
     *       "explicit": "boolean",
     *       "external_ids": array{
     *         "isrc": "string",
     *         "ean": "string",
     *         "upc": "string"
     *       },
     *       "external_urls": array{"spotify": "string"},
     *       "href": "string",
     *       "id": "string",
     *       "is_playable": "boolean",
     *       "linked_from": array{}|null,
     *       "restrictions": array{"reason": "string"}|null,
     *       "name": "string",
     *       "popularity": "integer",
     *       "preview_url": "string|null",
     *       "track_number": "integer",
     *       "type": "string",
     *       "uri": "string",
     *       "is_local": "boolean"
     *     }>
     *   },
     *   "artists": array{
     *     "href": "string",
     *     "limit": "integer",
     *     "next": "string|null",
     *     "offset": "integer",
     *     "previous": "string|null",
     *     "total": "integer",
     *     "items": array<array{
     *       "external_urls": array{"spotify": "string"},
     *       "followers": array{
     *         "href": "string|null",
     *         "total": "integer"
     *       },
     *       "genres": array<string>,
     *       "href": "string",
     *       "id": "string",
     *       "images": array<array{
     *         "url": "string",
     *         "height": "integer",
     *         "width": "integer"
     *       }>,
     *       "name": "string",
     *       "popularity": "integer",
     *       "type": "string",
     *       "uri": "string"
     *     }>
     *   },
     *   "albums": array{
     *     "href": "string",
     *     "limit": "integer",
     *     "next": "string|null",
     *     "offset": "integer",
     *     "previous": "string|null",
     *     "total": "integer",
     *     "items": array<array{
     *       "album_type": "string",
     *       "total_tracks": "integer",
     *       "available_markets": array<string>,
     *       "external_urls": array{"spotify": "string"},
     *       "href": "string",
     *       "id": "string",
     *       "images": array<array{
     *         "url": "string",
     *         "height": "integer",
     *         "width": "integer"
     *       }>,
     *       "name": "string",
     *       "release_date": "string",
     *       "release_date_precision": "string",
     *       "restrictions": array{"reason": "string"}|null,
     *       "type": "string",
     *       "uri": "string",
     *       "artists": array<array{
     *         "external_urls": array{"spotify": "string"},
     *         "href": "string",
     *         "id": "string",
     *         "name": "string",
     *         "type": "string",
     *         "uri": "string"
     *       }>
     *     }>
     *   },
     *   "playlists": array{
     *     "href": "string",
     *     "limit": "integer",
     *     "next": "string|null",
     *     "offset": "integer",
     *     "previous": "string|null",
     *     "total": "integer",
     *     "items": array<array{
     *       "collaborative": "boolean",
     *       "description": "string",
     *       "external_urls": array{"spotify": "string"},
     *       "href": "string",
     *       "id": "string",
     *       "images": array<array{
     *         "url": "string",
     *         "height": "integer",
     *         "width": "integer"
     *       }>,
     *       "name": "string",
     *       "owner": array{
     *         "external_urls": array{"spotify": "string"},
     *         "href": "string",
     *         "id": "string",
     *         "type": "string",
     *         "uri": "string",
     *         "display_name": "string"
     *       },
     *       "public": "boolean",
     *       "snapshot_id": "string",
     *       "tracks": array{
     *         "href": "string",
     *         "total": "integer"
     *       },
     *       "type": "string",
     *       "uri": "string"
     *     }>
     *   },
     *   "shows": array{
     *     "href": "string",
     *     "limit": "integer",
     *     "next": "string|null",
     *     "offset": "integer",
     *     "previous": "string|null",
     *     "total": "integer",
     *     "items": array<array{
     *       "available_markets": array<string>,
     *       "copyrights": array<array{
     *         "text": "string",
     *         "type": "string"
     *       }>,
     *       "description": "string",
     *       "html_description": "string",
     *       "explicit": "boolean",
     *       "external_urls": array{"spotify": "string"},
     *       "href": "string",
     *       "id": "string",
     *       "images": array<array{
     *         "url": "string",
     *         "height": "integer",
     *         "width": "integer"
     *       }>,
     *       "is_externally_hosted": "boolean",
     *       "languages": array<string>,
     *       "media_type": "string",
     *       "name": "string",
     *       "publisher": "string",
     *       "type": "string",
     *       "uri": "string",
     *       "total_episodes": "integer"
     *     }>
     *   },
     *   "episodes": array{
     *     "href": "string",
     *     "limit": "integer",
     *     "next": "string|null",
     *     "offset": "integer",
     *     "previous": "string|null",
     *     "total": "integer",
     *     "items": array<array{
     *       "audio_preview_url": "string|null",
     *       "description": "string",
     *       "html_description": "string",
     *       "duration_ms": "integer",
     *       "explicit": "boolean",
     *       "external_urls": array{"spotify": "string"},
     *       "href": "string",
     *       "id": "string",
     *       "images": array<array{
     *         "url": "string",
     *         "height": "integer",
     *         "width": "integer"
     *       }>,
     *       "is_externally_hosted": "boolean",
     *       "is_playable": "boolean",
     *       "language": "string",
     *       "languages": array<string>,
     *       "name": "string",
     *       "release_date": "string",
     *       "release_date_precision": "string",
     *       "resume_point": array{
     *         "fully_played": "boolean",
     *         "resume_position_ms": "integer"
     *       },
     *       "type": "string",
     *       "uri": "string",
     *       "restrictions": array{"reason": "string"}|null
     *     }>
     *   },
     *   "audiobooks": array{
     *     "href": "string",
     *     "limit": "integer",
     *     "next": "string|null",
     *     "offset": "integer",
     *     "previous": "string|null",
     *     "total": "integer",
     *     "items": array<array{
     *       "authors": array<array{"name": "string"}>,
     *       "available_markets": array<string>,
     *       "copyrights": array<array{
     *         "text": "string",
     *         "type": "string"
     *       }>,
     *       "description": "string",
     *       "html_description": "string",
     *       "edition": "string",
     *       "explicit": "boolean",
     *       "external_urls": array{"spotify": "string"},
     *       "href": "string",
     *       "id": "string",
     *       "images": array<array{
     *         "url": "string",
     *         "height": "integer",
     *         "width": "integer"
     *       }>,
     *       "languages": array<string>,
     *       "media_type": "string",
     *       "name": "string",
     *       "narrators": array<array{"name": "string"}>,
     *       "publisher": "string",
     *       "type": "string",
     *       "uri": "string",
     *       "total_chapters": "integer"
     *     }>
     *   }
     * }
     */

    public function search(SearchRequest $request)
    {

        $response = Http::withToken($request->bearerToken(), 'Bearer')->get(config('spotify.api_url') . '/v1/search', [
            'q' => $request->search,
            'type' => 'artist,track,album',
            'limit' => 5,
        ]);

        if ($response->successful()) {
            return response()->json($response->json(), $response->status());
        } else {
            return response()->json($response->json(), $response->status());
        }
    }
}
