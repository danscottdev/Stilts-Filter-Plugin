# Stilts REST API Filter Plugin

Dynamic front-end filtering capability, via custom REST endpoints.
  
## Goals:

  - Easily reusuable/extendable across sites, regardless of post types/taxonomies/meta filters
    - Filter on taxonomy (category, tag, custom),
    - Filter on metadata/ACF fields
    - Filter on date
    - Additive vs. exclusive (i.e. apply multiple filters to fine-tune results)
    - Pagination
  - Easy to configure/customize on a site-by-site basis, based on needed filter cases
    - config.json
  
    

## Gameplan:

  - [x] Restructure/cleanup to get to a good 'starting point' for further development
  - [ ] Start adding in post types from sites (oneaim, defund, m4bl, etc) one-by-one to tweak/test functionality
  - [ ] Try to simplify front-end requirements a little. Right now it depends on form + results div being structured a certain way
  - [ ] Add 'sort by newest/oldest/etc' functionality back in


## Ideas

  - There's lots of different potential "filter cases", might be helpful to set up some kind of automated testing to make sure nothing breaks as changes are made.
  - Try to allow for site-by-site code customization, while leaving core plugin files untouched? Maybe add action hooks throughout filter code, then a "/custom/" folder, where additional code can hook into core plugin? 

----------------------------------------------

## Current Filter Cases

**CPT: Resources (from OneAim)**  
  - Content via ACF
  - Test Page: stilts.local/resources

| Filter Case | Filter Field              | Notes |
|-------------|---------------------------|-------|
| Taxonomy    | Resource Types [category] |       |
| Taxonomy    | Resource Audiences [tag]  |       |
|             |                           |       |
