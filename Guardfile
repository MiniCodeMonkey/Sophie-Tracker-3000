guard :concat, :type => "css", :files => %w[dashboard flip icons modal notification sleep slider stats style utilities], :input_dir => "public/css", :output => "public/css/styles.min"

guard :concat, :type => "js", :files => %w[activity bath Chart diaper feed flip food jQuery.fastClick lastevent medicine milestone mobile note notification pump sleep spinner stats supplies track], :input_dir => "public/js", :output => "public/js/scripts.min"

guard :less, :all_on_start => true, :all_on_start => false, :output => 'public/css' do
	watch(%r[^app/assets/less/(.+\.less)$])
end

module ::Guard
  class Refresher < Guard
    def run_all
      # refresh
    end

    def run_on_additions(paths)
      refresh
    end

    def run_on_removals(paths)
      refresh
    end

    def refresh
      `php artisan guard:refresh`
    end
  end
end

require 'cssmin'
require 'jsmin'

guard :refresher do
  watch(%r[public/js/.+])
  watch(%r[public/css/.+])
  watch(%r{app/config/packages/way/guard-laravel/guard.php}) do |m|
    `php artisan guard:refresh`
  end
  watch('public/css/styles.min.css') do |m|
    css = File.read(m[0])
    File.open(m[0], 'w') { |file| file.write(CSSMin.minify(css)) }
  end
  watch('public/js/scripts.min.js') do |m|
    js = File.read(m[0])
    File.open(m[0], 'w') { |file| file.write(JSMin.minify(js)) }
  end
end