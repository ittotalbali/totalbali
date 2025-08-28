<?php

namespace App\Helpers;

class PaginationAdapter
{
    public static function convertToTheirFormat($yourPagination)
    {
        if (!isset($yourPagination->pagination)) {
            return $yourPagination;
        }

        $yourPag = $yourPagination->pagination;
        
        // Convert your format to their format
        $theirPagination = [
            'current_page' => $yourPag->page,
            'per_page' => $yourPag->size,
            'total' => $yourPag->total_count,
            'last_page' => $yourPag->total_pages
        ];

        return (object) [
            'data' => $yourPagination->data,
            'pagination' => (object) $theirPagination
        ];
    }
}